# Generated by Django 4.2.7 on 2023-11-09 12:21

from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Course',
            fields=[
                ('course_id', models.AutoField(primary_key=True, serialize=False)),
                ('course_name', models.CharField(max_length=100)),
                ('course_fee', models.DecimalField(decimal_places=2, max_digits=10)),
                ('date_created', models.DateField()),
            ],
        ),
    ]