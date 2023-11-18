from django.contrib import admin
from django.urls import path
from crmapp import views

urlpatterns = [
    path('', views.index, name='home'),
    path('dashboard', views.dashboard, name='dashboard'),

    path('all-course', views.all_course, name='all_course'),
    path('add-course/', views.add_edit_course, name='add_course'),  # Use the same view for add and edit
    path('edit-course/<int:course_id>/', views.add_edit_course, name='edit_course'),  # Use the same view for add and edit
    path('delete-course/<int:course_id>/', views.delete_course, name='delete_course'),

    
    path('all-candidate', views.all_candidate, name='all_candidate'),
    path('add-candidate', views.add_edit_candidate, name='add_candidate'),
    path('edit-candidate/<int:user_id>/', views.add_edit_candidate, name='edit_candidate'),
    path('delete_candidate/<int:user_id>/', views.delete_candidate, name='delete_candidate'),
    path('export-candidate',views.export_candidate, name='export_candidate'),
    path('export-enrollment',views.export_enrollment, name='export_enrollment'),
    path('export_enrollment_by_course/<int:course_id>/', views.export_enrollment_by_course, name='export_enrollment_by_course'),


    path('all-enrollment',views.all_enrollment, name='all_enrollment'),
    path('add-enrollment',views.add_edit_enrollment, name='add_enrollment'),
    path('edit-enrollment/<int:enrollment_id>/', views.add_edit_enrollment, name='edit_enrollment'),
    path('delete-enrollment/<int:enrollment_id>', views.delete_enrollment, name='delete_enrollment'),

    path('batches', views.faculty, name='batches'),
    path('add-batches', views.faculty, name='add-batches'),
    
    path('export-candidate', views.faculty, name='export-candidate'),
    path('fees-collections', views.faculty, name='fees-collections'),
    path('add-fees-collection', views.faculty, name='add-fees-collection'),
    path('faculty', views.faculty, name='faculty'),
    path('services', views.contact, name='services'),
    path('contact', views.contact, name='contact'),
]