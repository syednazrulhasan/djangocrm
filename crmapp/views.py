from django.shortcuts import render, HttpResponse, redirect, get_object_or_404
from datetime import datetime
from .models import Course,Userroles,Users
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
    candidates = Users.objects.filter(user_role__role_id=3)
    return render(request,'all-candidates.html',{'candidates': candidates})

def add_edit_candidate(request,user_id=None):
    if user_id:
        users = get_object_or_404(Users, user_id=user_id)
        userroles = Userroles.objects.all()
    else:
        users = None
        userroles = Userroles.objects.all()

    if request.method == "POST":
        record_id = request.POST.get('recordid')
        candidateunique = generate_unique_number()
        candidaterole = request.POST.get('candidaterole')
        candidatename = request.POST.get('candidatename')
        candidatephone = request.POST.get('candidatephone')
        candidateemail = request.POST.get('candidateemail')

        if user_id:  # Editing an existing course
            users.user_role_id = candidaterole
            users.user_name = candidatename
            users.user_phone = candidatephone
            users.user_email = candidateemail
            users.save()
            messages.success(request, 'Candidate Updated Successfully')
        else:  # Adding a new course
            users = Users(user_unique=candidateunique, user_role_id=candidaterole, user_name=candidatename, user_phone=candidatephone, user_email=candidateemail, date_created=datetime.today() )
            users.save()
            messages.success(request, 'Candidate Added Successfully')

        return redirect('all_candidate')

    return render(request, 'add-candidate.html', {'user': users, 'userroles':userroles})    


def faculty(request):
	return HttpResponse('this is about page')

def contact(request):
	return HttpResponse('this is contact page')


def generate_unique_number():
    last_user_id = get_last_inserted_user_id()  # Replace with your logic to fetch the last user_id
    if (last_user_id > 999 ):
        last_user_id = 1 
    # Increment the last user_id
    new_user_id = last_user_id + 1

    # Get the current month and year
    current_month = datetime.now().strftime('%m')
    current_year = datetime.now().strftime('%y')

    # Format the unique number
    unique_number = f"{new_user_id:04d}ST{current_month}{current_year}"
    return unique_number

def get_last_inserted_user_id():
    # Use order_by('-user_id') to get the latest entry first
    last_inserted_user = Users.objects.order_by('-user_id').values('user_id').first()
    # Extract the 'user_id' value from the result
    last_inserted_user_id = last_inserted_user['user_id'] if last_inserted_user else None
    return last_inserted_user_id