<x-layout title="Register | Create Ideas">
    <div class="flex justify-center my-30  h-screen">
        <form action="/register" method="POST">

            @csrf

            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend">Register</legend>
                <x-form.field label="Full Name" name="name" placeholder="Your Full Name"></x-form.field>
                <x-form.field label="Email" name="email" placeholder="Your Email"></x-form.field>
                <x-form.field label="Password" name="password" placeholder="Your Password"></x-form.field>

                <button class="btn btn-neutral mt-4">Register</button>
            </fieldset>
        </form>
    </div>
</x-layout>
