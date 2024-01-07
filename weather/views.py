from django.shortcuts import render
from django.http import JsonResponse
import requests
from datetime import datetime
from django.utils import timezone
from django.conf import settings


def get_weather(request):
    api_key = 'b1d27f9e89c352d54a322f63f8f7d318'
    city = 'Delhi'  # Replace with the name of your city
    country = 'IN'
    # OpenWeatherMap API endpoint
    api_url = f'http://api.openweathermap.org/data/2.5/weather?q={city},{country}&APPID={api_key}&units=metric'

    try:
        response = requests.get(api_url)
        data = response.json()

        # Extract relevant weather information from the API response
        temperature = data['main']['temp']
        description = data['weather'][0]['description']
        sunrise_timestamp = data['sys']['sunrise']
        sunset_timestamp = data['sys']['sunset']

        # Convert timestamps to datetime objects with timezone
        sunrise_datetime = timezone.datetime.fromtimestamp(sunrise_timestamp, timezone.get_current_timezone()).strftime('%I:%M:%S %p')
        sunset_datetime = timezone.datetime.fromtimestamp(sunset_timestamp, timezone.get_current_timezone()).strftime('%I:%M:%S %p')

        weather_data = {
            'temperature': temperature,
            'description': description,
            'sunrise': sunrise_datetime,
            'sunset': sunset_datetime,
        }

        return JsonResponse(weather_data)
    except Exception as e:
        # Handle API request errors
        return JsonResponse({'error': str(e)}, status=500)

