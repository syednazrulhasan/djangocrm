from django.shortcuts import render, HttpResponse

# Create your views here.
def index(request):
	content = {
		'username' : 'Chavi'
	}
	return render(request,'home.html',content)
	#return HttpResponse("this is home page")

def services(request):
	return HttpResponse('this is services page')

def about(request):
	return HttpResponse('this is about page')

def contact(request):
	return HttpResponse('this is contact page')