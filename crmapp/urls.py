from django.contrib import admin
from django.urls import path
from crmapp import views

urlpatterns = [
    path('', views.index, name='home'),
    path('dashboard', views.about, name='dashboard'),
    path('courses', views.courses, name='courses'),
    path('add-course', views.about, name='add-course'),
    path('batches', views.about, name='batches'),
    path('add-batches', views.about, name='add-batches'),
    path('candidates', views.services, name='candidates'),
    path('add-candidate', views.services, name='add-candidate'),
    path('export-candidate', views.services, name='export-candidate'),
    path('fees-collections', views.contact, name='fees-collections'),
    path('add-fees-collection', views.contact, name='add-fees-collection'),
    path('faculty', views.contact, name='faculty'),
    path('services', views.contact, name='services'),
    path('contact', views.contact, name='contact'),
]