from django.contrib import admin
from django.urls import path
from crmapp import views
from django.conf import settings
from django.conf.urls.static import static
from django.contrib.auth.decorators import login_required

urlpatterns = [
    path('', login_required(views.index), name='home'),
    path('dashboard', login_required(views.dashboard), name='dashboard'),

    path('all-course', login_required(views.all_course), name='all_course'),
    path('add-course/', login_required(views.add_edit_course), name='add_course'),  # Use the same view for add and edit
    path('edit-course/<int:course_id>/', login_required(views.add_edit_course), name='edit_course'),  # Use the same view for add and edit
    path('delete-course/<int:course_id>/', login_required(views.delete_course), name='delete_course'),

    
    path('all-candidate', login_required(views.all_candidate), name='all_candidate'),
    path('add-candidate', login_required(views.add_edit_candidate), name='add_candidate'),
    path('edit-candidate/<int:user_id>/', login_required(views.add_edit_candidate), name='edit_candidate'),
    path('delete_candidate/<int:user_id>/', login_required(views.delete_candidate), name='delete_candidate'),
    path('export-candidate', login_required(views.export_candidate), name='export_candidate'),
    path('export-enrollment',login_required(views.export_enrollment), name='export_enrollment'),
    path('export_enrollment_by_course/', login_required(views.export_enrollment_by_course), name='export_enrollment_by_course'),

    path('export_batch_students_csv/<int:batch_id>/', login_required(views.export_batch_students_csv), name='export_batch_students_csv'),

    path('all-enrollment',login_required(views.all_enrollment), name='all_enrollment'),
    path('add-enrollment',login_required(views.add_edit_enrollment), name='add_enrollment'),
    path('edit-enrollment/<int:enrollment_id>/', login_required(views.add_edit_enrollment), name='edit_enrollment'),
    path('delete-enrollment/<int:enrollment_id>', login_required(views.delete_enrollment), name='delete_enrollment'),
    path('get_enrollment_for_course/<int:course_id>/', login_required(views.get_enrollments_for_course), name='get_enrollment_for_course'),



    path('all-batch', login_required(views.all_batch), name='all_batch'),
    path('add-batch', login_required(views.add_edit_batch), name='add_batch'),
    path('edit-batch/<int:batch_id>', login_required(views.add_edit_batch), name='edit_batch'),
    path('get_students_for_batch/<int:batch_id>/', login_required(views.get_students_for_batch), name='get_batch_data'),
    path('export-candidate', login_required(views.faculty), name='export-candidate'),


    path('all-payments', login_required(views.all_collections), name='all_collections'),
    path('add-payment', login_required(views.add_edit_payment), name='add_payment'),
    path('edit-payment/<int:payment_id>', login_required(views.add_edit_payment), name='edit_payment'),
    path('export-payment', login_required(views.faculty), name='export_collections'),

    path('get_course_for_batch/<int:batch_id>/', login_required(views.get_course_for_batch), name='get_course_forbatch'),
    path('get_enrolled_candidates_for_course/<int:batch_id>/', login_required(views.get_enrolled_candidates_for_course), name='get_enrolled_candidates_for_course'),


    path('faculty', login_required(views.faculty), name='faculty'),


    path('login/', views.custom_login, name='login'),
    path('logout', views.custom_logout, name='logout'),

]


if settings.DEBUG:
    urlpatterns += static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)

