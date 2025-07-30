<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>2xMyLeads</title>
</head>

<body class="bg-blue-700">
    <div class="grid grid-cols-1 md:grid-cols-3 min-h-screen">
        <div class="col-span-2 hidden md:flex items-center justify-center">
            <img src="{{ asset('img/05.png') }}" alt="">
        </div>
        <div class="lg:col-span-1 lg:bg-white bg-white md:col-span-1 md:bg-white flex items-center justify-center">
            <form action="{{ route('login-user') }}" method="post">
                @csrf
                <div class="md:mx-5">
                    <div class="flex justify-center">
                        <img src="{{ asset('img/index.png') }}" class="w-36 h-auto">
                    </div>
                    @if(session('error'))
                        <div class="rounded-md bg-red-50 mt-6 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">{{ session('error') }}</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="flex justify-center mt-4">
                        <div class="w-50 h-auto">
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input type="text" name="email" placeholder="Email" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-50 h-auto">
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input type="password" name="password" placeholder="Password" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="w-1/2 bg-blue-500 hover:bg-pipexblue text-white py-2 px-4 rounded">Login</button>
                    </div>
                    <div class="flex justify-center mt-4">
                        <a href="{{ route('login-with-facebook') }}" class="w-1/2"><img src="{{ asset('img/facebook_button.png') }}" alt=""></a>
                    </div>
                    <div class="flex justify-center mt-4">
                        <a href="https://www.2xmyleads.com/help" target="_blank" class="text-red-500">Forgot password</a>
                    </div>

                    <footer class="bg-white">
                        <div class="mx-auto max-w-7xl overflow-hidden px-6 py-20 sm:py-24 lg:px-8">
                            <nav class="text-center" aria-label="Footer">
                                <div class="pb-1">
                                    <a href="https://www.2xmyleads.com/Privacy-Policies" target="_blank" class="text-xs leading-6 text-gray-600 hover:text-gray-900"><u>Privacy Policy</u></a>
                                </div>
                            </nav>
                            <div class="mt-10 flex justify-center space-x-10">
                                <a href="https://www.facebook.com/2xMyLeads" target="_blank" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="https://www.instagram.com/2xmyleads" target="_blank" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Instagram</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/company/2xmyleads" target="_blank" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Twitter</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19px" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                        <rect x="2" y="9" width="4" height="12"></rect>
                                        <circle cx="4" cy="4" r="2"></circle>
                                    </svg>
                                </a>
                            </div>
                            <p class="mt-10 text-center text-xs leading-5 text-gray-500">&copy; 2023 2xMyBiz.com Marketing Inc. All rights reserved.</p>
                        </div>
                    </footer>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
