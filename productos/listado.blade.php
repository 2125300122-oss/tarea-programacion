@extends('plantilla.layout')

@section('contenido')
<div class="mb-8 border-b border-gray-100 pb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <span class="text-blue-600 font-extrabold text-xs uppercase tracking-widest block mb-1">Módulo Productos / Medicamentos</span>
        <h1 class="text-3xl font-black text-blue-900">Catálogo de Medicamentos e Inventario</h1>
        <p class="text-sm text-gray-500 mt-1">Consulta e inventario general de medicamentos y productos farmacéuticos.</p>
    </div>
    <!-- BOTÓN AGREGAR PRODUCTO -->
    <a href="{{ url('/productos/formulario') }}" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-bold rounded-xl text-sm px-5 py-3 shadow-md transition-all flex items-center justify-center gap-2">
        <i class="bi bi-capsule text-lg"></i> Agregar Nuevo Producto
    </a>
</div>

<!-- TABLA DE PRODUCTOS (ESTRUCTURA DE DISEÑO) -->
<div class="relative overflow-x-auto shadow-md sm:rounded-2xl border border-gray-100 bg-white">
    <table class="w-full text-sm text-left text-gray-600">
        <thead class="text-xs text-blue-900 uppercase bg-blue-50/70 border-b border-gray-100">
            <tr>
                <th scope="col" class="px-6 py-4 font-black">ID</th>
                <th scope="col" class="px-6 py-4 font-black">Medicamento / Producto</th>
                <th scope="col" class="px-6 py-4 font-black">Descripción / Compuesto</th>
                <th scope="col" class="px-6 py-4 font-black">Precio Unitario</th>
                <th scope="col" class="px-6 py-4 font-black">Stock</th>
                <th scope="col" class="px-6 py-4 font-black text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- SIN DATOS CARGADOS (PURO DISEÑO) -->
            <tr>
                <td colspan="6" class="p-10 text-center text-gray-400 italic bg-white">
                    <i class="bi bi-inbox text-3xl block mb-2 text-gray-300"></i>
                    No hay productos registrados en la base de datos.
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
