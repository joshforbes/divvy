<img style="border: 1px solid transparent; border-radius: 5px; box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);" src="{{ asset('images/divvy-email.jpg') }}" alt="Divvy Logo"/>

<p>We received a request to reset your password.</p>
Click here to reset your password:

<a style="padding: 5px 15px; background-color: #184D59; color:white; text-decoration: none;" href="{{ url('password/reset/'.$token) }}">Reset</a>


