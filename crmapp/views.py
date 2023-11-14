from django.shortcuts import render, HttpResponse, redirect, get_object_or_404
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

def dashboard(request):
    return HttpResponse("this is dashboard page")

def all_course(request):
	all_courses = Course.objects.all()
	context = {'courses': all_courses}
	return render(request,'all-course.html',context)

def add_edit_course(request, course_id=None):
    if course_id:
        course = get_object_or_404(Course, course_id=course_id)
    else:
        course = None

    if request.method == "POST":
        record_id = request.POST.get('recordid')
        course_name = request.POST.get('coursename')
        course_fee = request.POST.get('coursefee')
        courseduration = request.POST.get('courseduration')

        if course_id:
            # Editing an existing course
            course.course_name = course_name
            course.course_fee = course_fee
            course.course_duration = courseduration
            course.save()
            messages.success(request, 'Course Updated Successfully')
        else:
            # Adding a new course
            course = Course(course_name=course_name, course_fee=course_fee, course_duration=courseduration, date_created=datetime.today())
            course.save()
            messages.success(request, 'Course Added Successfully')

        return redirect('all_course')

    return render(request, 'course.html', {'coursedetails': course})	

def delete_course(request,course_id):
	deleteit = Course.objects.get(course_id=course_id)	
	deleteit.delete()
	messages.success(request,'Course Deleted Succesfully')
	return redirect('all_course')


def all_candidate(request):
    return HttpResponse('this is all candidate page')

def add_edit_candidate(request,course_id=None):
    return HttpResponse('this is add edit candidate page')

def faculty(request):
	return HttpResponse('this is about page')

def contact(request):
	return HttpResponse('this is contact page')