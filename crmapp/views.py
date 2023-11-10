from django.shortcuts import render, HttpResponse ,redirect
from datetime import datetime
from .models import Course
from django.contrib import messages

# Create your views here.
def index(request):
	content = {
		'username' : 'Chavi'
	}
	return render(request,'home.html',content)
	#return HttpResponse("this is home page")

def all_course(request):
	all_courses = Course.objects.all()
	context = {'courses': all_courses}
	return render(request,'all-course.html',context)

def add_course(request):
	if request.method == "POST":
		course_name = request.POST.get('coursename')
		course_fee  = request.POST.get('coursefee')
		courseduration = request.POST.get('courseduration')
		course = Course(course_name = course_name, course_fee = course_fee, course_duration = courseduration, date_created= datetime.today())
		course.save()
		messages.success(request,'Course Added Succesfully')
		return redirect('all_course')
	return render(request,'add-course.html')

def edit_course(request,course_id):
	editcourse = Course.objects.get(course_id=course_id)	

	messages.success(request,'Course Updated Succesfully')
	return redirect('all_course')
	

def delete_course(request,course_id):
	deleteit = Course.objects.get(course_id=course_id)	
	deleteit.delete()
	messages.success(request,'Course Deleted Succesfully')
	return redirect('all_course')
	
def services(request):
	return HttpResponse('this is services page')

def about(request):
	return HttpResponse('this is about page')

def contact(request):
	return HttpResponse('this is contact page')