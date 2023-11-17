from django.db import models

# Create your models here.
class Course(models.Model):
    course_id = models.AutoField(primary_key=True)
    course_name = models.CharField(max_length=100)
    course_fee = models.DecimalField(max_digits=10, decimal_places=2)
    course_duration = models.CharField(max_length=100, default='')
    date_created = models.DateField()

class Userroles(models.Model):
    role_id = models.AutoField(primary_key=True)
    role_type = models.CharField(max_length=100)
    role_created = models.DateField()

    
class Users(models.Model):
    user_id = models.AutoField(primary_key=True)
    user_unique = models.CharField(max_length=100)
    user_role = models.ForeignKey(Userroles, on_delete=models.SET_NULL, null=True, blank=True)
    user_name = models.CharField(max_length=255)
    user_phone = models.CharField(max_length=15)
    user_email = models.CharField(max_length=320)
    date_created = models.DateField(default='2023-11-15')

class Enrollment(models.Model):
    enrollment_id = models.AutoField(primary_key=True)
    candidate_id = models.ForeignKey(Users, on_delete=models.SET_NULL, null=True, blank=True)
    course_id = models.ForeignKey(Course, on_delete=models.SET_NULL, null=True, blank=True)
    date_created = models.DateField()