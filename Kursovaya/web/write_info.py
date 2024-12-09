import random

def generate_random_number(start, end):
    return random.randint(start, end)

def generate_random_number2(start, end):
    return random.randint(start, end)

# Список аудиторий
auditoriums = ["A-123", "Б-234", "В-148", "Б-145", "А-245", "Г-467"]
time = ["9:00", "10:30", "12:40", "14:20", "16:20", "18:00"]

start = 0
end = len(auditoriums) - 1
end2 = len(time) - 1

# Генерируем случайное число
random_number = generate_random_number(start, end)

random_number2 = generate_random_number2(start, end2)

# Получаем случайную аудиторию
random_auditorium = auditoriums[random_number]

random_time = time[random_number2]


answer = random_auditorium + ", " + random_time
print(f"Выбранная аудитория: {answer}")
