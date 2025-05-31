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

print("API KEY:", os.getenv("OPENROUTER_API_KEY"))  # Asegúrate que no esté vacío
print("Conectando a MySQL con:", os.getenv("MYSQL_HOST"), os.getenv("MYSQL_USER"))


class ChatRequest(BaseModel):
    message: str

@app.post("/chat")
async def chat(request: ChatRequest):
    try:
        # Paso 1: clasificar la intención
        clasificacion = client.chat.completions.create(
            model="deepseek/deepseek-chat-v3-0324:free",
            messages=[
                {"role": "system", "content": "If the question you ask has nothing to do with the database, answer it as if you were a normal model."},
                {"role": "system", "content": "It only responds with 'query' if the user's message requires a SQL query to a database. If you don't require a consultation, respond only with 'chat'."},
                {"role": "user", "content": request.message}
            ]
        )
        tipo = clasificacion.choices[0].message.content.strip().lower()

        if "chat" in tipo:
            # Conversación normal
            respuesta = client.chat.completions.create(
                model="deepseek/deepseek-chat-v3-0324:free",
                messages=[
                    {"role": "system", "content": "Always respond in Spanish. You are a friendly assistant. Call the user Rodrigo. Be brief."},
                    {"role": "user", "content": request.message}
                ]
            )
            return {"response": respuesta.choices[0].message.content}

        elif "query" in tipo:
            # Generación de consulta SQL
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
            - pregunta1 (int)
            - pregunta2 (int)
            - pregunta3 (int)
            - pregunta4 (int)
            - pregunta5 (int)
            - fecha (date)
            - estado (tinyint) carry out = 1, not carry out = 0
            - idAlumno (foreign_key)
            - idMaestro (foreign_key)
            - tutorias (varchar(50))
            """
            reglas = """
            It only generates the necessary SQL query based on the question.
            No explanations, just plain SQL.
            """
            contexto = """
            You are a virtual assistant that helps generate queries to obtain data from students of the Instituto Tecnologico Superior de Tacambaro.
            """

            # Ejemplos para que el modelo entienda mejor qué esperas:
            ejemplos = """
            Example 1:
            Pregunta: ¿Cuántos alumnos hay en el semestre 8?
            SQL: SELECT COUNT(*) FROM alumnos WHERE semestre = '8';

            Example 2:
            Pregunta: Dame el nombre y correo de los alumnos del grupo A.
            SQL: SELECT nombre, correo FROM alumnos WHERE grupo = 'A';

            Example 3:
            Pregunta: ¿Cuántas evaluaciones están completas o realizadas?
            SQL: SELECT COUNT(*) FROM evaluaciones WHERE estado = 1;

            Example 4:
            Pregunta: ¿Cuántas evaluaciones no se han realizo o sin completar?
            SQL: SELECT COUNT(*) FROM evaluaciones WHERE estado = 0;

            Example 4:
            Pregunta: ¿Que tutor o maestro esta asignado o pertenece a este grupo ISC-8-A?
            SQL: SELECT DISTINCT m.nombre, m.apellidos FROM maestros m JOIN evaluaciones e ON m.id = e.idMaestro WHERE e.tutorias = 'ISC-8-A';
            """

            consulta = client.chat.completions.create(
                model="deepseek/deepseek-chat-v3-0324:free",
                messages=[
                    {"role": "system", "content": tablassql},
                    {"role": "system", "content": reglas},
                    {"role": "system", "content": contexto},
                    {"role": "system", "content": ejemplos},
                    {"role": "user", "content": request.message}
                ]
            )

            sql = consulta.choices[0].message.content.strip()
            print("Consulta generada:", repr(sql))  # Para depuración

            # Validación de consulta generada
            if not sql.lower().startswith("select"):
                raise HTTPException(status_code=400, detail=f"Consulta inválida generada: {sql}")

            # Conexión y ejecución
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

            # Resumen para el modelo
            resumen = f"La consulta fue: '{sql}'.\nColumnas: {cols}\nResultados: {rows[:3]}..."

            interpretacion = client.chat.completions.create(
                model="deepseek/deepseek-chat-v3-0324:free",
                messages=[
                    {"role": "system", "content": "You are an assistant who converts database results into concise, human-readable answers in Spanish."},
                    {"role": "user", "content": f"User question: {request.message}\nQuery results: {rows}\nColumns: {cols}"}
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
        print("Error en el servidor:", str(e))
        raise HTTPException(status_code=500, detail=str(e))


@app.get("/")
async def root():
    return {"message": "El backend está funcionando"}
