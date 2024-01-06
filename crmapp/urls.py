from django.contrib import admin
from django.urls import path
from crmapp import views
from django.conf import settings
from django.conf.urls.static import static

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
    path('export_enrollment_by_course/', views.export_enrollment_by_course, name='export_enrollment_by_course'),

    path('export_batch_students_csv/<int:batch_id>/', views.export_batch_students_csv, name='export_batch_students_csv'),

    path('all-enrollment',views.all_enrollment, name='all_enrollment'),
    path('add-enrollment',views.add_edit_enrollment, name='add_enrollment'),
    path('edit-enrollment/<int:enrollment_id>/', views.add_edit_enrollment, name='edit_enrollment'),
    path('delete-enrollment/<int:enrollment_id>', views.delete_enrollment, name='delete_enrollment'),
    path('get_enrollment_for_course/<int:course_id>/', views.get_enrollments_for_course, name='get_enrollment_for_course'),



    path('all-batch', views.all_batch, name='all_batch'),
    path('add-batch', views.add_edit_batch, name='add_batch'),
    path('edit-batch/<int:batch_id>', views.add_edit_batch, name='edit_batch'),
    path('get_students_for_batch/<int:batch_id>/', views.get_students_for_batch, name='get_batch_data'),
    
    path('export-candidate', views.faculty, name='export-candidate'),


    path('all-payments', views.all_collections, name='all_collections'),
    path('add-payment', views.add_edit_payment, name='add_payment'),
    path('edit-payment/<int:payment_id>', views.add_edit_payment, name='edit_payment'),
    path('export-payment', views.faculty, name='export_collections'),

    path('get_course_for_batch/<int:batch_id>/', views.get_course_for_batch, name='get_course_forbatch'),
    path('get_enrolled_candidates_for_course/<int:batch_id>/', views.get_enrolled_candidates_for_course, name='get_enrolled_candidates_for_course'),


    path('faculty', views.faculty, name='faculty'),

]


if settings.DEBUG:
    urlpatterns += static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)

