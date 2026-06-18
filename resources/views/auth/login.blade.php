<x-layout title="Register | Create Ideas">
    <div class="flex justify-center my-30  h-screen">
        <form action="/login" method="POST">

            @csrf

            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend">Login</legend>
                <x-form.field label="Email" type="email" name="email" placeholder="Your Email"></x-form.field>
                <x-form.field label="Password" type="password" name="password" placeholder="Your Password"></x-form.field>

                <button class="btn btn-neutral mt-4">Login</button>
            </fieldset>
        </form>
    </div>
</x-layout>