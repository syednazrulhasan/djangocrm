from django.shortcuts import render, HttpResponse, redirect, get_object_or_404
from datetime import datetime
from .models import Course,Userroles,Users,Enrollment,Batch,Payments
from django.contrib import messages
import csv,os,random,string,time
from django.http import HttpResponse
from django.utils import timezone
from django.core.paginator import Paginator, EmptyPage, PageNotAnInteger
from django.core.serializers import serialize
from django.http import JsonResponse
from django.core.files.storage import default_storage
from django.core.exceptions import ValidationError
from django.db.models import Sum
from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.decorators import login_required

# Create your views here.
def index(request):
	content = {
		'username' : 'AHSPL'
	}
	return render(request,'home.html',content)
	#return HttpResponse("this is home page")

def dashboard(request):
    return render(request,'dashboard.html')

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
    candidates_list = Users.objects.all()

    # Set the number of items to display per page
    items_per_page = 10  # You can adjust this value as needed

    # Create a Paginator instance
    paginator = Paginator(candidates_list, items_per_page)

    # Get the current page number from the request's GET parameters
    page = request.GET.get('page')

    try:
        candidates = paginator.page(page)
    except PageNotAnInteger:
        # If page is not an integer, deliver the first page.
        candidates = paginator.page(1)
    except EmptyPage:
        # If page is out of range (e.g., 9999), deliver the last page.
        candidates = paginator.page(paginator.num_pages)

    return render(request, 'all-candidates.html', {'candidates': candidates})


def add_edit_candidate(request,user_id=None):
    if user_id:
        users = get_object_or_404(Users, user_id=user_id)
        userroles = Userroles.objects.all()
        courses   = Course.objects.all()
    else:
        users = None
        userroles = Userroles.objects.all()
        courses   = Course.objects.all()

    if request.method == "POST":    
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

    return render(request, 'candidate.html', {'user': users, 'courses':courses, 'userroles':userroles})    


def delete_candidate(request,user_id):
    delete = Users.objects.get(user_id=user_id)
    delete.delete()
    messages.success(request,'Candidate Deleted Succesfully')
    return redirect('all_candidate')

def all_enrollment(request):
    # Aggregate the payment amounts based on candidate_id and course_id
    payment_aggregation = Payments.objects.values('candidate_id', 'course_id').annotate(total_payment=Sum('payment_amount'))

    # Create a dictionary to store the total payments for each combination of candidate_id and course_id
    total_payments_dict = {(payment['candidate_id'], payment['course_id']): payment['total_payment'] for payment in payment_aggregation}

    # Fetch all enrollments
    enrollments = Enrollment.objects.all()

    # Calculate fee paid and fee remaining for each enrollment
    for enrollment in enrollments:
        candidate_id = enrollment.candidate_id_id
        course_id = enrollment.course_id_id

        # Get the total payment for the current candidate and course combination
        total_payment = total_payments_dict.get((candidate_id, course_id), 0)

        # Get the course_fee from the related Course model
        course_fee = enrollment.course_id.course_fee

        # Calculate fee paid and fee remaining
        fee_paid = total_payment
        fee_remaining = course_fee - fee_paid

        # Add fee_paid and fee_remaining to the enrollment instance
        enrollment.fee_paid = fee_paid
        enrollment.fee_remaining = fee_remaining

    return render(request, 'all-enrollments.html', {'enrollments': enrollments})

def add_edit_enrollment(request, enrollment_id=None):
    candidates = Users.objects.filter(user_role__role_id=3)
    courses = Course.objects.all()

    if enrollment_id:
        enrollment = get_object_or_404(Enrollment, enrollment_id=enrollment_id)
    else:
        enrollment = None

    if request.method == 'POST':
        candidate_id = request.POST.get('candidaterole')
        course_id = request.POST.get('candidatecourse')

        candidate_instance = get_object_or_404(Users, pk=candidate_id)
        course_instance = get_object_or_404(Course, pk=course_id)

        if enrollment_id:
            # Editing existing enrollment
            enrollment.candidate_id = candidate_instance
            enrollment.course_id = course_instance
            enrollment.date_created = datetime.today()
            enrollment.save()
            messages.success(request, 'Enrollment updated successfully')
            return redirect('all_enrollment')
        else:
            # Adding new enrollment
            new_enrollment = Enrollment(candidate_id=candidate_instance, course_id=course_instance, date_created=datetime.today())
            new_enrollment.save()
            messages.success(request, 'Enrollment added successfully')

            return redirect('all_enrollment')

    return render(request, 'enrollment.html', {'candidates': candidates, 'courses': courses, 'enrollments': enrollment })

def delete_enrollment(request,enrollment_id):
    enrollment = get_object_or_404(Enrollment, pk=enrollment_id)
    enrollment.delete()
    messages.success(request,'Enrollment Deleted Succesfully')
    return redirect('all_enrollment')


def export_candidate(request):
    candidates = Users.objects.all()

    # Create a response object with appropriate CSV headers
    response = HttpResponse(content_type='text/csv')
    response['Content-Disposition'] = f'attachment; filename="candidates_{timezone.now().strftime("%Y%m%d%H%M%S")}.csv"'

    # Create a CSV writer and write the header
    writer = csv.writer(response)
    writer.writerow(['ID', 'Name', 'Phone', 'Email', 'Role'])

    # Write each candidate's data to the CSV file
    for candidate in candidates:
        writer.writerow([candidate.user_id, candidate.user_name, candidate.user_phone, candidate.user_email, candidate.user_role.role_type])

    return response

def export_enrollment_by_course(request):
    course_id = request.GET.get('candidatecourse')

    if not course_id:
        # Handle the case where no course is selected
        return HttpResponse('Please select a course.')

    # Fetch enrollments based on the selected course_id
    enrollments = Enrollment.objects.filter(course_id=course_id).select_related('candidate_id')

    # Create a response object with appropriate CSV headers
    response = HttpResponse(content_type='text/csv')
    response['Content-Disposition'] = f'attachment; filename="enrollments_course_{course_id}.csv"'

    # Create a CSV writer and write the header
    writer = csv.writer(response)
    writer.writerow(['Candidate ID', 'Candidate Name', 'Phone', 'Email', 'Role', 'Date Created'])

    # Write each enrollment's data to the CSV file
    for enrollment in enrollments:
        writer.writerow([
            enrollment.candidate_id.user_id,
            enrollment.candidate_id.user_name,
            enrollment.candidate_id.user_phone,
            enrollment.candidate_id.user_email,
            enrollment.candidate_id.user_role.role_type,
            enrollment.date_created
        ])

    return response

def export_enrollment(request):
    courses = Course.objects.all()
    default_course_id = courses.first().course_id if courses.exists() else None
    return render(request, 'export-enrollment.html', {'courses': courses, 'default_course_id': default_course_id})

def all_batch(request):
    batches_with_course = Batch.objects.select_related('course_id').all()
    return render(request, 'all-batches.html', {'batches': batches_with_course })

def add_edit_batch(request, batch_id=None):
    courses = Course.objects.all()
    candida = Users.objects.filter(user_role__role_id=3)

    candidates_list = [] 

    if batch_id:
        oldbatch = get_object_or_404(Batch,pk=batch_id)
        if oldbatch.candidates:
            candidates_list = [int(id_str) for id_str in oldbatch.candidates.split(',')]
        else:
            candidates_list = []

    else:
        oldbatch = None

    if request.method =="POST":


        batchname = request.POST.get('batchname')
        courseid = request.POST.get('candidatecourse')
        selected_students = request.POST.getlist('batchstudents[]', [])
        batchstudents = ','.join(selected_students)
        batchstartdate = request.POST.get('batchstartdate')
        course_instance = get_object_or_404(Course, pk=courseid)
       

        if batch_id:
            oldbatch = get_object_or_404(Batch,pk=batch_id)
            oldbatch.batch_name = batchname
            oldbatch.course_id = course_instance
            oldbatch.candidates = batchstudents
            oldbatch.start_date = batchstartdate
            oldbatch.save()
            messages.success(request, 'Batch Updated Successfully')
        else:
            newbatch = Batch( batch_name=batchname,course_id=course_instance,candidates=batchstudents,start_date=batchstartdate,date_created=datetime.today() )

            newbatch.save()
            messages.success(request, 'Batch Created Successfully')
        return redirect('all_batch')

    return render(request, 'batch.html', {'courses': courses, 'candidates': candida, 'batches': oldbatch,'candidates_list':candidates_list } )

def get_enrolled_candidates_for_course(request, batch_id):
    batch = get_object_or_404(Batch, pk=batch_id)

    # Get all enrolled candidates for the course associated with the batch
    enrolled_candidates = Enrollment.objects.filter(course_id=batch.course_id)

    # Get the IDs of previously enrolled candidates in the batch
    previously_enrolled_ids = [int(candidate_id) for candidate_id in batch.candidates.split(',')]

    # Prepare the data for the multiselect field
    enrolled_candidates_data = []
    for candidate in enrolled_candidates:
        enrollment_data = {
            'id': candidate.candidate_id.user_id,
            'text': candidate.candidate_id.user_name,
            'selected': candidate.candidate_id.user_id in previously_enrolled_ids,
        }
        enrolled_candidates_data.append(enrollment_data)

    if enrolled_candidates_data:
        return JsonResponse({'enrolled_candidates_data': enrolled_candidates_data})
    else:
        return JsonResponse({'error': 'No enrollments found for the given batch ID'}, status=404)


def get_enrollments_for_course(request, course_id):
    enrollments = Enrollment.objects.filter(course_id=course_id,candidate_id__user_role__role_id=3)

    if enrollments.exists():
        response_data = []
        for enrollment in enrollments:
            enrollment_data = {
                'enrollment_id': enrollment.enrollment_id,
                'candidate_id': enrollment.candidate_id.user_id,
                'course_id': enrollment.course_id.course_id,
                'candidate_name': enrollment.candidate_id.user_name,
                # Add other fields as needed
            }
            response_data.append(enrollment_data)

        return JsonResponse({'enrollments': response_data})
    else:
        return JsonResponse({'error': 'Enrollments not found for the given course_id'}, status=404)


# this function is used to fetch students belonging to particular batch in an ajax call
def get_students_for_batch(request, batch_id):
    batch = get_object_or_404(Batch, batch_id=batch_id)
    student_ids = [int(student_id) for student_id in batch.candidates.split(',')]
    
    students = Users.objects.filter(user_id__in=student_ids)

    student_list = [{'user_id': student.user_id, 'user_name': student.user_name, 'user_phone':student.user_phone } for student in students]

    return JsonResponse({'students': student_list})

# this function is used to fetch course belonging to particular batch in an ajax call
def get_course_for_batch(request, batch_id):
    batch = get_object_or_404(Batch, batch_id=batch_id)
    course_id = batch.course_id_id
    courses = get_object_or_404(Course,pk=course_id)
    course_data = {
        'id'  : courses.course_id,
        'name': courses.course_name,
        # Add other fields as needed
    }
    return JsonResponse({'course':course_data})

# this function is used to export the code as csv for batch 
def export_batch_students_csv(request, batch_id):
    # Fetch data for the specified batch
    batch = get_object_or_404(Batch, pk=batch_id)

    # Create a response object with CSV content type
    response = HttpResponse(content_type='text/csv')
    response['Content-Disposition'] = f'attachment; filename="batch_{batch_id}_students.csv"'

    # Create a CSV writer
    writer = csv.writer(response)

    # Write header row
    writer.writerow(['Batch Name', 'Course Name', 'Student Names'])

    # Fetch student details from Users model using the stored user_ids
    student_ids = [int(id_str) for id_str in batch.candidates.split(',') if id_str]
    students = Users.objects.filter(user_id__in=student_ids)

    # Write data row with batch name, course name, and comma-separated student names
    student_names = ', '.join([student.user_name for student in students])
    writer.writerow([batch.batch_name, batch.course_id.course_name, student_names])

    return response

def all_collections(request):
    payments_list = Payments.objects.all()

    # Set the number of items to display per page
    items_per_page = 10  # You can adjust this value as needed

    # Create a Paginator instance
    paginator = Paginator(payments_list, items_per_page)

    # Get the current page number from the request's GET parameters
    page = request.GET.get('page')

    try:
        payments = paginator.page(page)
    except PageNotAnInteger:
        # If page is not an integer, deliver the first page.
        payments = paginator.page(1)
    except EmptyPage:
        # If page is out of range (e.g., 9999), deliver the last page.
        payments = paginator.page(paginator.num_pages)


    return render(request, 'all-payments.html',{'payments':payments})

def add_edit_payment(request, payment_id=None):
    batchdata = Batch.objects.all()

    if request.method == 'POST':
        batch_id = request.POST.get('selectbatch')
        course_id = request.POST.get('selectcourse')
        candidate_id = request.POST.get('selectcandidate')

        if batch_id and course_id and candidate_id:
            batchinstance = get_object_or_404(Batch, pk=batch_id)
            courseinstance = get_object_or_404(Course, pk=course_id)
            candidateinstance = get_object_or_404(Users, user_id=candidate_id)

            payment_amount = request.POST.get('payment_amount')
            payment_reference_file = request.FILES.get('payment_reference')

            if payment_reference_file:
                # Save the file to the specified folder
                random_str = generate_random_name()

                # Extract the file extension from the original name
                file_name, file_extension = os.path.splitext(payment_reference_file.name)

                # Create a new file name with the random string and original file extension
                new_file_name = f'{random_str}{file_extension}'

                # Combine with the path
                file_path = os.path.join('payment_references/', new_file_name)

                try:
                    with default_storage.open(file_path, 'wb+') as destination:
                        for chunk in payment_reference_file.chunks():
                            destination.write(chunk)
                except Exception as e:
                    # Handle any potential errors during file saving
                    messages.error(request, f'Error saving file: {e}')
                    return redirect('all_collections')

            else:
                # If no file was provided, set file_path to None
                file_path = None

            # Create a new Payments instance with or without payment_reference
            paymentwa = Payments.objects.create(
                batch_id=batchinstance,
                candidate_id=candidateinstance,
                course_id=courseinstance,
                payment_amount=payment_amount,
                payment_reference=file_path,
                date_created=timezone.now()
            )

            messages.success(request, 'Payment Added Successfully')
            return redirect('all_collections')
        else:
            messages.warning(request, 'Incomplete data provided.')

    return render(request, 'payments.html', {'batchdata': batchdata})


def faculty(request):
	return HttpResponse('this is about page')


# this function is used to fetch courses students have enrolled to in an ajax call
def get_courses_for_student(request, user_id):
    # Fetch the user's enrollments with course information
    enrollments = Enrollment.objects.filter(candidate_id=user_id).select_related('course_id')

    # Extract course information from enrollments
    courses_info = []
    for enrollment in enrollments:
        course_info = {
            'course_id': enrollment.course_id.course_id,
            'course_name': enrollment.course_id.course_name,
            'course_fee': enrollment.course_id.course_fee,
            'course_duration': enrollment.course_id.course_duration,
        }
        courses_info.append(course_info)

    return JsonResponse({'courses': courses_info})


def generate_unique_number():
    last_user_id = get_last_inserted_user_id()  # Replace with your logic to fetch the last user_id
    if last_user_id is not None:
        if last_user_id > 999:
            last_user_id = 1
    else:
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





def generate_random_name():
    # Combine digits, uppercase letters, and lowercase letters
    all_characters = string.digits + string.ascii_letters

    # Generate a random 15-character string
    random_string = ''.join(random.choice(all_characters) for _ in range(15))

    # Get the current timestamp
    current_timestamp = str(int(time.time()))

    # Concatenate the random string with the timestamp
    result = random_string + current_timestamp

    return result


def custom_login(request):
    if request.method == 'POST':
        username = request.POST['username']
        password = request.POST['password']
        user = authenticate(request, username=username, password=password)
        if user is not None:
            login(request, user)
            return redirect('home')  # Redirect to your dashboard or home page
        else:
            # Handle invalid login
            return render(request, 'login.html', {'error_message': 'Invalid credentials'})

    # If the user is already authenticated, redirect to the dashboard
    if request.user.is_authenticated:
        return redirect('dashboard')

    return render(request, 'login.html')


def custom_logout(request):
    logout(request)
    return redirect('login')  # Redirect to your login page