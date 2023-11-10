from django.db import models

# Create your models here.
class Course(models.Model):
	course_id   	= models.AutoField(primary_key=True)
	course_name 	= models.CharField(max_length=100)
	course_fee  	= models.DecimalField(max_digits=10, decimal_places=2)
	course_duration = models.CharField(max_length=100,default='')
	date_created 	= models.DateField()