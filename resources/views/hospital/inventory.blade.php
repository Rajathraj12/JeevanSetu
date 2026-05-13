@extends('layouts.app')
@section('title', 'Inventory - JeevanSetu')

@section('content')
@php
$items = [
    ['id' => 'MED-001', 'name' => 'Paracetamol 500mg',   'category' => 'Medicine',   'stock' => 120,  'min' => 200, 'unit' => 'Tablets',  'supplier' => 'Sun Pharma',    'expiry' => '2027-03-01'],
    ['id' => 'MED-002', 'name' => 'Amoxicillin 250mg',   'category' => 'Medicine',   'stock' => 340,  'min' => 100, 'unit' => 'Capsules', 'supplier' => 'Cipla',         'expiry' => '2027-08-15'],
    ['id' => 'MED-003', 'name' => 'IV Saline (500ml)',   'category' => 'IV Fluid',   'stock' => 45,   'min' => 100, 'unit' => 'Bags',     'supplier' => 'Baxter',        'expiry' => '2026-12-01'],
    ['id' => 'EQP-001', 'name' => 'Surgical Gloves (L)', 'category' => 'Equipment',  'stock' => 600,  'min' => 200, 'unit' => 'Pairs',    'supplier' => 'Ansell',        'expiry' => '2028-01-01'],
    ['id' => 'EQP-002', 'name' => 'N95 Masks',           'category' => 'Equipment',  'stock' => 80,   'min' => 200, 'unit' => 'Units',    'supplier' => '3M India',      'expiry' => '2027-06-01'],
    ['id' => 'MED-004', 'name' => 'Insulin (Rapid)',     'category' => 'Medicine',   'stock' => 28,   'min' => 50,  'unit' => 'Vials',    'supplier' => 'Novo Nordisk',  'expiry' => '2026-09-30'],
    ['id' => 'CON-001', 'name' => 'Oxygen Cylinders',   'category' => 'Consumable', 'stock' => 12,   'min' => 20,  'unit' => 'Units',    'supplier' => 'INOX Air',      'expiry' => 'N/A'],
    ['id' => 'MED-005', 'name' => 'Metformin 500mg',     'category' => 'Medicine',   'stock' => 500,  'min' => 100, 'unit' => 'Tablets',  'supplier' => 'Lupin',         'expiry' => '2027-11-01'],
];
$catColors = ['Medicine' => 'bg-blue-100 text-blue-700', 'IV Fluid' => 'bg-purple-100 text-purple-700', 'Equipment' => 'bg-slate-100 text-slate-700', 'Consumable' => 'bg-orange-100 text-orange-700'];
$lowStock = array_filter($items, fn($i) => $i['stock'] < $i['min']);
@endphp

<div class="flex flex-col gap-8" id="inventory-app">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Inventory</h2>
            <p class="text-body-md text-on-surface-variant">{{ $hospital ? $hospital->name : 'Your Facility' }} — Manage medicines, equipment & consumables.</p>
        </div>
        <button onclick="document.getElementById('add-item-modal').classList.remove('hidden')"
            class="bg-secondary hover:bg-secondary/90 text-white font-bold py-2.5 px-5 rounded-xl shadow-sm flex items-center gap-2 transition-colors">
            <span class="material-symbols-outlined text-[20px]">add_circle</span> Add Item
        </button>
    </div>

    <!-- Summary -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Total Items</p>
            <p class="text-3xl font-bold text-slate-900">{{ count($items) }}</p>
        </div>
        <div class="bg-red-50 rounded-xl border border-red-100 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-red-500 uppercase mb-1">Low Stock Alert</p>
            <p class="text-3xl font-bold text-red-600">{{ count($lowStock) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Medicines</p>
            <p class="text-3xl font-bold text-blue-600">{{ count(array_filter($items, fn($i) => $i['category'] === 'Medicine')) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 text-center shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Equipment</p>
            <p class="text-3xl font-bold text-slate-600">{{ count(array_filter($items, fn($i) => $i['category'] === 'Equipment')) }}</p>
        </div>
    </div>

    @if(count($lowStock) > 0)
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center gap-3">
        <span class="material-symbols-outlined text-red-500 text-3xl">warning</span>
        <div>
            <p class="font-bold text-red-700">{{ count($lowStock) }} item(s) are below minimum stock threshold!</p>
            <p class="text-sm text-red-500">{{ implode(', ', array_column(iterator_to_array(new ArrayIterator($lowStock)), 'name')) }}</p>
        </div>
    </div>
    @endif

    <!-- Inventory Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-4">
            <h3 class="font-bold text-slate-800 flex items-center gap-2 mr-auto">
                <span class="material-symbols-outlined text-secondary">inventory_2</span> Stock List
            </h3>
            <input type="text" id="inv-search" placeholder="Search items..." oninput="filterInventory()"
                class="px-3 py-1.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none w-48">
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="inv-table">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase">ID</th>
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase">Item</th>
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase">Category</th>
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase">Stock</th>
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase">Supplier</th>
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase">Expiry</th>
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100" id="inv-body">
                    @foreach($items as $item)
                    @php $isLow = $item['stock'] < $item['min']; @endphp
                    <tr class="hover:bg-slate-50 transition-colors inv-row {{ $isLow ? 'bg-red-50/30' : '' }}" data-name="{{ strtolower($item['name']) }}">
                        <td class="px-5 py-4 text-xs font-bold text-slate-400">{{ $item['id'] }}</td>
                        <td class="px-5 py-4">
                            <p class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                {{ $item['name'] }}
                                @if($isLow)<span class="text-[10px] bg-red-100 text-red-600 px-1.5 py-0.5 rounded font-bold">LOW</span>@endif
                            </p>
                            <p class="text-xs text-slate-400">Min: {{ $item['min'] }} {{ $item['unit'] }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-xs font-bold px-2 py-1 rounded-full {{ $catColors[$item['category']] }}">{{ $item['category'] }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <button onclick="adjustStock(this, -10)" class="w-6 h-6 rounded bg-slate-100 hover:bg-red-100 text-slate-600 hover:text-red-600 font-bold text-sm flex items-center justify-center transition-colors">−</button>
                                <span class="font-bold text-sm min-w-[40px] text-center stock-val {{ $isLow ? 'text-red-600' : 'text-slate-800' }}">{{ $item['stock'] }}</span>
                                <button onclick="adjustStock(this, +10)" class="w-6 h-6 rounded bg-slate-100 hover:bg-emerald-100 text-slate-600 hover:text-emerald-600 font-bold text-sm flex items-center justify-center transition-colors">+</button>
                                <span class="text-xs text-slate-400">{{ $item['unit'] }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $item['supplier'] }}</td>
                        <td class="px-5 py-4 text-sm {{ $item['expiry'] !== 'N/A' && $item['expiry'] < '2026-12-01' ? 'text-red-600 font-bold' : 'text-slate-600' }}">{{ $item['expiry'] }}</td>
                        <td class="px-5 py-4 text-right">
                            <button onclick="reorderItem('{{ $item['name'] }}')"
                                class="text-xs font-bold px-3 py-1.5 bg-secondary/10 text-secondary rounded-lg hover:bg-secondary hover:text-white transition-colors flex items-center gap-1 ml-auto">
                                <span class="material-symbols-outlined text-[14px]">refresh</span> Reorder
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Item Modal -->
<div id="add-item-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-slate-800 px-6 py-4 flex justify-between items-center">
            <h3 class="text-white font-bold text-lg">Add Inventory Item</h3>
            <button onclick="document.getElementById('add-item-modal').classList.add('hidden')" class="text-white/60 hover:text-white"><span class="material-symbols-outlined">close</span></button>
        </div>
        <div class="p-6 flex flex-col gap-4">
            <div><label class="block text-sm font-bold text-slate-700 mb-1">Item Name</label>
                <input type="text" placeholder="e.g. Morphine 10mg" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none"></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-bold text-slate-700 mb-1">Category</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none">
                        <option>Medicine</option><option>IV Fluid</option><option>Equipment</option><option>Consumable</option>
                    </select></div>
                <div><label class="block text-sm font-bold text-slate-700 mb-1">Initial Stock</label>
                    <input type="number" placeholder="Qty" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none"></div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-bold text-slate-700 mb-1">Min. Threshold</label>
                    <input type="number" placeholder="Min qty" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none"></div>
                <div><label class="block text-sm font-bold text-slate-700 mb-1">Expiry Date</label>
                    <input type="date" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-secondary outline-none"></div>
            </div>
            <button onclick="document.getElementById('add-item-modal').classList.add('hidden'); showToast('Item added to inventory!');"
                class="w-full bg-secondary text-white font-bold py-3 rounded-xl hover:bg-secondary/90 transition-colors shadow-md mt-2">Add to Inventory</button>
        </div>
    </div>
</div>

<script>
function adjustStock(btn, delta) {
    const valEl = btn.parentElement.querySelector('.stock-val');
    let val = parseInt(valEl.textContent) + delta;
    if (val < 0) val = 0;
    valEl.textContent = val;
}
function reorderItem(name) {
    showToast('Reorder request sent for: ' + name);
}
function filterInventory() {
    const q = document.getElementById('inv-search').value.toLowerCase();
    document.querySelectorAll('.inv-row').forEach(r => {
        r.style.display = r.dataset.name.includes(q) ? '' : 'none';
    });
}
function showToast(msg) {
    const t = document.createElement('div');
    t.className = 'fixed bottom-6 right-6 z-[999] bg-secondary text-white font-bold px-5 py-3 rounded-xl shadow-xl flex items-center gap-2';
    t.innerHTML = '<span class="material-symbols-outlined">check_circle</span>' + msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 2800);
}
document.getElementById('add-item-modal').addEventListener('click', e => { if(e.target===e.currentTarget) e.currentTarget.classList.add('hidden'); });
</script>
@endsection
