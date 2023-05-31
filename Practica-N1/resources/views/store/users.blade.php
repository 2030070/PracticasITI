@extends('auth.dashboard')

@section('tables')
    <!-- Contenido de la página donde se muestra la tabla de usuarios-->

    <div class="md:flex  md:justify-center md:gap-10 md:items-center" >
        
        <div class="md:w-12/12 p-15 rounded-xl shadow-xl flex bg-gray-300">
            <div class="flex-1">
                <div class="p-6">
                    <!-- titulo de la seccion representada-->
                    <h1 class="text-4xl font-bold text-center text-cyan-700">Usuarios</h1>
                    {{-- tabla con los campos generados --}}
                    <table class="mt-6 w-full bg-white border-2 border-cyan-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Nombre</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--iteraciones de las tablas-->
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
    </div>
@endsection
