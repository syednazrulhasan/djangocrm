from django.shortcuts import render, HttpResponse
from datetime import datetime
from .models import Course
from django.shortcuts import render

# Create your views here.
def index(request):
	content = {
		'username' : 'Chavi'
	}
	return render(request,'home.html',content)
	#return HttpResponse("this is home page")

def courses(request):
	if request.method == "POST":
		course_name = request.POST.get('coursename')
		course_fee  = request.POST.get('coursefee')
		course = Course(course_name = course_name,course_fee = course_fee, date_created= datetime.today()  )
		course.save()
	return render(request,'courses.html')

def services(request):
	return HttpResponse('this is services page')

def about(request):
	return HttpResponse('this is about page')

def contact(request):
	return HttpResponse('this is contact page')