from django.urls import path
from .views import get_weather

urlpatterns = [
    path('get-weather/', get_weather, name='get_weather'),
]