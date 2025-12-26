<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">
            Dashboard
        </h2>
    </x-slot>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Products --}}
        <div class="bg-[#1E1E1E] rounded-2xl p-6 border border-[#2A2A2A]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#A0A0A0]">Total Products</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ count($my_products) }}</p>
                </div>
                <div class="w-12 h-12 bg-[#2D68F8]/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#2D68F8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <a href="{{ route('admin.products.index') }}" class="text-[#2D68F8] hover:text-[#5A8AF8] font-medium transition-colors">
                    View all →
                </a>
            </div>
        </div>

        {{-- Order Success --}}
        <div class="bg-[#1E1E1E] rounded-2xl p-6 border border-[#2A2A2A]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#A0A0A0]">Order Success</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ count($total_order_success) }}</p>
                </div>
                <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-emerald-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Completed orders
            </div>
        </div>

        {{-- Order Pending --}}
        <div class="bg-[#1E1E1E] rounded-2xl p-6 border border-[#2A2A2A]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#A0A0A0]">Order Pending</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ count($total_order_pending) }}</p>
                </div>
                <div class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-amber-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Awaiting payment
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="bg-[#1E1E1E] rounded-2xl p-6 border border-[#2A2A2A]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-[#A0A0A0]">Total Revenue</p>
                    <p class="text-2xl font-bold text-white mt-1">Rp {{ number_format($my_revenue, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-green-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                From all sales
            </div>
        </div>
    </div>

    {{-- Earning History Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Daily Earnings Chart (Last 30 Days) --}}
        <div class="bg-[#1E1E1E] rounded-2xl p-6 border border-[#2A2A2A]">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-white">Daily Earnings</h3>
                    <p class="text-sm text-[#A0A0A0]">Last 30 days</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center gap-1">
                        <div class="w-3 h-3 rounded-full bg-[#2D68F8]"></div>
                        <span class="text-xs text-[#A0A0A0]">Revenue</span>
                    </div>
                </div>
            </div>
            <div class="h-64">
                <canvas id="dailyEarningsChart"></canvas>
            </div>
            <div class="mt-4 pt-4 border-t border-[#2A2A2A]">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-[#A0A0A0]">Total (30 days)</span>
                    <span class="font-semibold text-white">Rp {{ number_format(array_sum($earningHistory['data']), 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm mt-1">
                    <span class="text-[#A0A0A0]">Orders (30 days)</span>
                    <span class="font-semibold text-white">{{ array_sum($earningHistory['orders']) }} orders</span>
                </div>
            </div>
        </div>

        {{-- Monthly Earnings Chart (Last 12 Months) --}}
        <div class="bg-[#1E1E1E] rounded-2xl p-6 border border-[#2A2A2A]">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-white">Monthly Earnings</h3>
                    <p class="text-sm text-[#A0A0A0]">Last 12 months</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center gap-1">
                        <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                        <span class="text-xs text-[#A0A0A0]">Revenue</span>
                    </div>
                </div>
            </div>
            <div class="h-64">
                <canvas id="monthlyEarningsChart"></canvas>
            </div>
            <div class="mt-4 pt-4 border-t border-[#2A2A2A]">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-[#A0A0A0]">Total (12 months)</span>
                    <span class="font-semibold text-white">Rp {{ number_format(array_sum($monthlyEarningHistory['data']), 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm mt-1">
                    <span class="text-[#A0A0A0]">Orders (12 months)</span>
                    <span class="font-semibold text-white">{{ array_sum($monthlyEarningHistory['orders']) }} orders</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-[#1E1E1E] rounded-2xl p-6 border border-[#2A2A2A] mb-8">
        <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.products.create') }}"
               class="flex items-center gap-4 p-4 rounded-xl border border-[#2A2A2A] hover:border-[#2D68F8] hover:bg-[#2D68F8]/10 transition-all group">
                <div class="w-10 h-10 bg-[#2D68F8]/20 rounded-lg flex items-center justify-center group-hover:bg-[#2D68F8]/30 transition-colors">
                    <svg class="w-5 h-5 text-[#2D68F8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-white">Add New Product</p>
                    <p class="text-sm text-[#A0A0A0]">Create a new product listing</p>
                </div>
            </a>

            <a href="{{ route('admin.product_orders.index') }}"
               class="flex items-center gap-4 p-4 rounded-xl border border-[#2A2A2A] hover:border-emerald-500 hover:bg-emerald-500/10 transition-all group">
                <div class="w-10 h-10 bg-emerald-500/20 rounded-lg flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-white">View Orders</p>
                    <p class="text-sm text-[#A0A0A0]">Manage incoming orders</p>
                </div>
            </a>

            <a href="{{ route('front.index') }}"
               class="flex items-center gap-4 p-4 rounded-xl border border-[#2A2A2A] hover:border-purple-500 hover:bg-purple-500/10 transition-all group">
                <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center group-hover:bg-purple-500/30 transition-colors">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-white">View Store</p>
                    <p class="text-sm text-[#A0A0A0]">See your public storefront</p>
                </div>
            </a>
        </div>
    </div>

    {{-- Recent Products --}}
    @if(count($my_products) > 0)
    <div class="bg-[#1E1E1E] rounded-2xl border border-[#2A2A2A]">
        <div class="flex items-center justify-between p-6 border-b border-[#2A2A2A]">
            <h3 class="text-lg font-semibold text-white">Recent Products</h3>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-[#2D68F8] hover:text-[#5A8AF8] font-medium transition-colors">
                View all →
            </a>
        </div>
        <div class="divide-y divide-[#2A2A2A]">
            @foreach($my_products->take(5) as $product)
            <div class="flex items-center gap-4 p-4 hover:bg-[#2A2A2A]/50 transition-colors">
                <img src="{{ Storage::url($product->cover) }}"
                     class="w-12 h-12 rounded-lg object-cover"
                     alt="{{ $product->name }}">
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-white truncate">{{ $product->name }}</p>
                    <p class="text-sm text-[#A0A0A0]">{{ $product->category->name }}</p>
                </div>
                <div class="text-right">
                    @if($product->price == 0)
                        <span class="text-sm font-medium text-emerald-500">FREE</span>
                    @else
                        <span class="text-sm font-medium text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Chart.js CDN --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart.js default configuration for dark theme
            Chart.defaults.color = '#A0A0A0';
            Chart.defaults.borderColor = '#2A2A2A';

            // Daily Earnings Chart
            const dailyCtx = document.getElementById('dailyEarningsChart').getContext('2d');
            new Chart(dailyCtx, {
                type: 'line',
                data: {
                    labels: @json($earningHistory['labels']),
                    datasets: [{
                        label: 'Revenue',
                        data: @json($earningHistory['data']),
                        borderColor: '#2D68F8',
                        backgroundColor: 'rgba(45, 104, 248, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#2D68F8',
                        pointBorderColor: '#2D68F8',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#2D68F8',
                        pointRadius: 0,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: '#1E1E1E',
                            titleColor: '#fff',
                            bodyColor: '#A0A0A0',
                            borderColor: '#2A2A2A',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed.y;
                                    const orders = @json($earningHistory['orders'])[context.dataIndex];
                                    return [
                                        'Revenue: Rp ' + new Intl.NumberFormat('id-ID').format(value),
                                        'Orders: ' + orders
                                    ];
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                            ticks: {
                                maxTicksLimit: 7,
                                font: {
                                    size: 11
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#2A2A2A',
                            },
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                    }
                                    return 'Rp ' + value;
                                },
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });

            // Monthly Earnings Chart
            const monthlyCtx = document.getElementById('monthlyEarningsChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'bar',
                data: {
                    labels: @json($monthlyEarningHistory['labels']),
                    datasets: [{
                        label: 'Revenue',
                        data: @json($monthlyEarningHistory['data']),
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: '#10B981',
                        borderWidth: 0,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: '#1E1E1E',
                            titleColor: '#fff',
                            bodyColor: '#A0A0A0',
                            borderColor: '#2A2A2A',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed.y;
                                    const orders = @json($monthlyEarningHistory['orders'])[context.dataIndex];
                                    return [
                                        'Revenue: Rp ' + new Intl.NumberFormat('id-ID').format(value),
                                        'Orders: ' + orders
                                    ];
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#2A2A2A',
                            },
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                    }
                                    return 'Rp ' + value;
                                },
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
