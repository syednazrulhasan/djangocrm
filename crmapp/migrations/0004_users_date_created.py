# Generated by Django 4.2.7 on 2023-11-14 20:44

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('crmapp', '0003_userroles_users'),
    ]

    operations = [
        migrations.AddField(
            model_name='users',
            name='date_created',
            field=models.DateField(default='2023-11-15'),
        ),
    ]
