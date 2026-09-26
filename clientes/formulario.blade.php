@extends('plantilla.layout')

@section('contenido')
<div class="max-w-4xl mx-auto">
    <!-- ENCABEZADO DEL FORMULARIO -->
    <div class="mb-8 border-b border-gray-100 pb-4 flex items-center justify-between">
        <div>
            <span class="text-blue-600 font-extrabold text-xs uppercase tracking-widest block mb-1">Módulo Clientes</span>
            <h1 class="text-3xl font-black text-blue-900">Formulario de Alta de Cliente</h1>
            <p class="text-sm text-gray-500 mt-1">Registre la información general de los clientes de la farmacia.</p>
        </div>
        <a href="{{ url('/clientes/listado') }}" class="text-gray-600 bg-gray-100 hover:bg-gray-200 font-bold rounded-xl text-xs px-4 py-2.5 transition-all flex items-center gap-1">
            <i class="bi bi-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <!-- FORMULARIO -->
    <form action="{{ url('/clientes/formulario') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid gap-6 md:grid-cols-2">
            <!-- NOMBRES -->
            <div>
                <label for="nombres" class="block mb-2 text-sm font-bold text-gray-700">Nombres <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
                        <i class="bi bi-person"></i>
                    </div>
                    <input type="text" id="nombres" name="nombres" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" title="Solo letras y espacios" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-3" placeholder="Ej. Ana Sofía" required>
                </div>
            </div>

            <!-- APELLIDOS -->
            <div>
                <label for="apellidos" class="block mb-2 text-sm font-bold text-gray-700">Apellidos <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <input type="text" id="apellidos" name="apellidos" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" title="Solo letras y espacios" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-3" placeholder="Ej. Martínez Fernández" required>
                </div>
            </div>

            <!-- TELÉFONO -->
            <div>
                <label for="telefono" class="block mb-2 text-sm font-bold text-gray-700">Teléfono <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <input type="text" id="telefono" name="telefono" inputmode="numeric" pattern="[0-9]+" title="Solo números" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-3" placeholder="3331112233" required>
                </div>
            </div>

            <!-- CORREO ELECTRÓNICO -->
            <div>
                <label for="correo" class="block mb-2 text-sm font-bold text-gray-700">Correo Electrónico <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <input type="email" id="correo" name="correo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-3" placeholder="cliente@correo.com" required>
                </div>
            </div>
        </div>

        <!-- DIRECCIÓN DE ENTREGA -->
        <div>
            <label for="direccion" class="block mb-2 text-sm font-bold text-gray-700">Dirección Completa (Opcional)</label>
            <textarea id="direccion" name="direccion" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3" placeholder="Av. Hidalgo #123, Col. Centro, Guadalajara, Jal."></textarea>
        </div>

        <!-- FOTO DE PERFIL / COMPROBANTE -->
        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700" for="imagen">Fotografía / Identificación (Opcional)</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-xl cursor-pointer bg-gray-50 p-2.5 focus:outline-none" id="imagen" name="imagen" type="file" accept="image/*">
        </div>

        <!-- BOTONES DE ACCIÓN -->
        <div class="pt-4 flex items-center gap-4">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-bold rounded-xl text-sm px-6 py-3 transition-all shadow-md flex items-center gap-2">
                <i class="bi bi-person-check-fill"></i> Guardar Cliente
            </button>
            <button type="reset" class="text-gray-700 bg-gray-100 hover:bg-gray-200 font-bold rounded-xl text-sm px-6 py-3 transition-all">
                Limpiar
            </button>
        </div>
    </form>
</div>
@endsection
