from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from openai import OpenAI
from dotenv import load_dotenv
import mysql.connector
import os

load_dotenv()

app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_methods=["POST", "GET"],
    allow_headers=["*"],
)

client = OpenAI(
    api_key=os.getenv("OPENROUTER_API_KEY"),
    base_url="https://openrouter.ai/api/v1"
)

class ChatRequest(BaseModel):
    message: str

@app.post("/chat")
async def chat(request: ChatRequest):
    try:
        # Primer paso: clasificar la intención del usuario
        clasificacion = client.chat.completions.create(
            model="deepseek/deepseek-chat-v3-0324:free",
            messages=[
                {"role": "system", "content" : "If the question you ask has nothing to do with the database, answer it as if you were a normal model."},
                {"role": "system", "content": "It only responds with 'query' if the user's message requires a SQL query to a database. If you don't require a consultation, respond only with 'chat'."},
                {"role": "user", "content": request.message}
            ]
        )
        tipo = clasificacion.choices[0].message.content.strip().lower()

        if "chat" in tipo:
            # Solo responder de forma conversacional
            respuesta = client.chat.completions.create(
                model="deepseek/deepseek-chat-v3-0324:free",
                messages=[
                    {"role": "system", "content": "Always respond in Spanish. You are a friendly assistant. Call the user Rodrigo. Be brief."},
                    {"role": "user", "content": request.message}
                ]
            )
            return {"response": respuesta.choices[0].message.content}

        elif "query" in tipo:
            tablassql = """
            Table: alumnos
            Columns:
            - id (int, primary key)
            - nombre (varchar(50))
            - apellidos (varchar(70))
            - numeroControl (varchar(70))
            - correo (varchar(70))
            - password (varchar(70))
            - semestre (varchar(30))
            - carrera (varchar(30))
            - grupo (char(1))

            Table: maestros
            Columns:
            - id (int, primary key))
            - nombre (varchar(50))
            - apellidos (varchar(60))
            - numero (varchar(60))

            Table: evaluaciones
            Columns:
            - id (int, primary key))
            - pregunta1 (int) Value of question1
            - pregunta2 (int) Value of question2
            - pregunta3 (int) Value of question3
            - pregunta4 (int) Value of question4
            - pregunta5 (int) Value of question5
            - fecha (date)
            - estado (tinyint) 0:Evaluation is not complete 1:Evaluation complete
            - idAlumno (foreign_key) foreign key for table alumnos
            - idMaestro (foreign_key) foreign key for table maestros
            - tutorias (varchar(50)) name of group example:ISC-8-A (ISC:Ingenieria en Sistemas Coomputacionales (carrera), 8:Semestre, A:Grupo)
            """
            reglas = """
            Respond in Spanish.
            It only generates the necessary SQL query based on the question.
            No explanations, just plain SQL.
            """
            contexto = """
            You are a virtual assistant that helps generate queries to obtain data from students of the Instituto Tecnologico Superior de Tacambaro.
            """

            consulta = client.chat.completions.create(
                model="deepseek/deepseek-chat-v3-0324:free",
                messages=[
                    {"role": "system", "content": tablassql},
                    {"role": "system", "content": reglas},
                    {"role": "system", "content": contexto},
                    {"role": "user", "content": request.message}
                ]
            )

            sql = consulta.choices[0].message.content.strip()

            conn = mysql.connector.connect(
                host=os.getenv("MYSQL_HOST"),
                user=os.getenv("MYSQL_USER"),
                password=os.getenv("MYSQL_PASSWORD"),
                database=os.getenv("MYSQL_DATABASE")
            )
            cursor = conn.cursor()
            cursor.execute(sql)
            rows = cursor.fetchall()
            cols = [desc[0] for desc in cursor.description]
            cursor.close()
            conn.close()

            # ✨ Construir descripción natural del resultado
            resumen = f"La consulta fue: '{sql}'.\nColumnas: {cols}\nResultados: {rows[:3]}..."

            # 👇 Manda el resultado al modelo para que genere una respuesta natural
            interpretacion = client.chat.completions.create(
                model="deepseek/deepseek-chat-v3-0324:free",
                messages=[
                    {"role": "system", "content": "Eres un asistente que convierte resultados de base de datos en respuestas entendibles por humanos, en español y de forma concisa."},
                    {"role": "user", "content": f"Pregunta del usuario: {request.message}\nResultados de la consulta: {rows}\nColumnas: {cols}"}
                ]
            )

            respuesta_final = interpretacion.choices[0].message.content.strip()

            return {
                "sql": sql,
                "response": respuesta_final
            }

        else:
            return {"response": "No entendí tu intención, Rodrigo. ¿Puedes reformular tu pregunta?"}

    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))


@app.get("/")
async def root():
    return {"message": "El backend está funcionando"}
