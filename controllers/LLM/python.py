from transformers import AutoModelForCausalLM, AutoTokenizer, pipeline

# ID del modelo en Hugging Face
modelo_id = "microsoft/phi-2"

# Cargar el modelo en CPU
modelo = AutoModelForCausalLM.from_pretrained(modelo_id, device_map="cpu")
tokenizador = AutoTokenizer.from_pretrained(modelo_id)

# Crear el pipeline para generar texto
pipe = pipeline("text-generation", model=modelo, tokenizer=tokenizador, device=-1)

# Probar el modelo
pregunta = "Genera una consulta SQL para obtener todos los usuarios que compraron en 2024."
respuesta = pipe(pregunta, max_length=100)
print(respuesta[0]["generated_text"])
