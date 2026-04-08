@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.index') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver al Inicio
    </a>
</div>

<div class="mb-10 flex flex-col items-center text-center gap-6">
    <div>
        <h2 class="text-4xl font-display text-textMain tracking-tight">Registro de Órdenes</h2>
        <p class="text-gray-500 font-medium">Revisa las solicitudes de los clientes.</p>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-accent/10 border-b border-accent/10">
                <tr>
                    <th class="px-8 py-5 text-left text-xs font-bold text-textMain uppercase tracking-widest">ID</th>
                    <th class="px-8 py-5 text-left text-xs font-bold text-textMain uppercase tracking-widest">Cliente</th>
                    <th class="px-8 py-5 text-left text-xs font-bold text-textMain uppercase tracking-widest">Total</th>
                    <th class="px-8 py-5 text-left text-xs font-bold text-textMain uppercase tracking-widest">Estado</th>
                    <th class="px-8 py-5 text-right text-xs font-bold text-textMain uppercase tracking-widest">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-accent/5 transition-colors duration-200">
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="text-base font-bold text-gray-400">#{{ $order->id }}</div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="text-base font-bold text-textMain">
                            @if($order->customer)
                                {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                            @else
                                {{ $order->customer_name ?? 'Anónimo' }}
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="text-lg font-display text-primary tracking-tighter">${{ number_format($order->total, 2) }}</div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $order->status == 'Pendiente' ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline-block" 
                                onsubmit="event.preventDefault(); Swal.fire({
                                    title: '¿Eliminar Orden?',
                                    text: 'Esta acción no se puede revertir.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#E71D36',
                                    cancelButtonColor: '#24140a',
                                    confirmButtonText: '¡Sí, borrar!',
                                    cancelButtonText: 'No, cancelar'
                                }).then((result) => {
                                    if (result.isConfirmed) { this.submit(); }
                                })">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-accent/10 text-accent hover:bg-accent hover:text-white h-10 w-10 flex items-center justify-center rounded-xl transition shadow-sm" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="text-gray-400 font-medium">No se han recibido órdenes aún.</div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
