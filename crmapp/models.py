from django.db import models
from datetime import datetime

# Create your models here.
class Course(models.Model):
    course_id = models.AutoField(primary_key=True)
    course_name = models.CharField(max_length=100)
    course_fee = models.DecimalField(max_digits=10, decimal_places=2)
    course_duration = models.CharField(max_length=100, default='')
    date_created = models.DateField(default=datetime.today)

class Userroles(models.Model):
    role_id = models.AutoField(primary_key=True)
    role_type = models.CharField(max_length=100)
    role_created = models.DateField(default=datetime.today)

class Users(models.Model):
    user_id = models.AutoField(primary_key=True)
    user_unique = models.CharField(max_length=100)
    user_role = models.ForeignKey(Userroles, on_delete=models.SET_NULL, null=True, blank=True)
    user_name = models.CharField(max_length=255)
    user_phone = models.CharField(max_length=15)
    user_email = models.CharField(max_length=320)
    date_created = models.DateField(default=datetime.today)

class Enrollment(models.Model):
    enrollment_id = models.AutoField(primary_key=True)
    candidate_id = models.ForeignKey(Users, on_delete=models.SET_NULL, null=True, blank=True)
    course_id = models.ForeignKey(Course, on_delete=models.SET_NULL, null=True, blank=True)
    date_created = models.DateField(default=datetime.today)

class Batch(models.Model):
    batch_id = models.AutoField(primary_key=True)
    batch_name = models.CharField(max_length=255)
    course_id = models.ForeignKey(Course, on_delete=models.SET_NULL, null=True, blank=True)
    candidates = models.TextField()
    start_date = models.DateField(default=datetime.today)
    date_created = models.DateField(default=datetime.today)

class Payments(models.Model):
    payment_id = models.AutoField(primary_key=True)
    batch_id = models.ForeignKey(Batch, on_delete=models.SET_NULL,null=True, blank= True)
    candidate_id = models.ForeignKey(Enrollment, on_delete=models.SET_NULL, null=True, blank=True)
    course_id = models.ForeignKey(Course,on_delete=models.SET_NULL,null=True, blank=True)
    payment_amount = models.TextField()
    payment_reference = models.ImageField(upload_to='payment_references/', null=True, blank=True)
    date_created = models.DateField(default=datetime.today)