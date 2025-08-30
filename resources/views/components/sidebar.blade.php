<aside id="sidebar"
       :class="{
           '-translate-x-full': !sidebarOpen && !isDesktop, {{-- Oculto si sidebar cerrado y no es desktop --}}
           'translate-x-0': sidebarOpen || isDesktop,        {{-- Visible si sidebar abierto O es desktop --}}
           'absolute': !isDesktop,                           {{-- Absoluto en móvil para superponerse --}}
           'md:relative': isDesktop                          {{-- Relativo en desktop para empujar contenido --}}
       }"
       class="
           bg-gray-800 text-white
           w-64 space-y-6 py-7 px-2
           inset-y-0 left-0
           transition duration-200 ease-in-out
           z-50
       ">
    <div class="flex items-center px-4">
        <a href="#" class="text-white text-2xl font-semibold uppercase">Opciones</a>
    </div>
    <nav>
        <a href="{{route('admin.dashboard')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-home mr-2"></i> Inicio
        </a>
        <div x-data="{ productsSubmenuOpen: false }"> {{-- x-data para el estado del submenú --}}
            <a href="#" @click.prevent="productsSubmenuOpen = !productsSubmenuOpen"
               class="flex items-center justify-between py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                <div>
                    <i class="fas fa-shirt mr-2"></i> Productos
                </div>
                <i class="fas fa-chevron-down ml-2 transform"
                   :class="{ 'rotate-180': productsSubmenuOpen }"></i>
            </a>            
            <!-- Submenú de Productos -->
            <div x-show="productsSubmenuOpen" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="ml-4 mt-1 space-y-1">
                 <a href="{{route('admin.products.create')}}" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white text-sm">
                     <i class="fas fa-plus mr-2"></i> Nuevo Producto
                 </a>    
                <a href="{{route('admin.products')}}" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white text-sm">
                    <i class="fas fa-list mr-2"></i> Todos los Productos
                </a>
                <a href="{{route('admin.product_variants')}}" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white text-sm">
                    <i class="fas fa-list mr-2"></i> Variantes de Productos
                </a>
            </div>
        </div>
        <div x-data="{ categoriesSubmenuOpen: false }"> {{-- x-data para el estado del submenú --}}
            <a href="#" @click.prevent="categoriesSubmenuOpen = !categoriesSubmenuOpen"
               class="flex items-center justify-between py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                <div>
                    <i class="fas fa-circle mr-2"></i> Categorias
                </div>
                <i class="fas fa-chevron-down ml-2 transform"
                   :class="{ 'rotate-180': categoriesSubmenuOpen }"></i>
            </a>            
            <!-- Submenú de Categorias -->
            <div x-show="categoriesSubmenuOpen" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="ml-4 mt-1 space-y-1">
                <a href="{{route('admin.categories')}}" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white text-sm">
                    <i class="fas fa-list mr-2"></i> Ver Categorias
                </a>
                <a href="{{route('admin.categories.create')}}" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white text-sm">
                    <i class="fas fa-plus mr-2"></i> Nueva Categoria
                </a>    
            </div>
        </div>
        <div x-data="{ makersSubmenuOpen: false }"> {{-- x-data para el estado del submenú --}}
            <a href="#" @click.prevent="makersSubmenuOpen = !makersSubmenuOpen"
               class="flex items-center justify-between py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                <div>
                    <i class="fas fa-industry mr-2"></i> Fabricantes
                </div>
                <i class="fas fa-chevron-down ml-2 transform"
                   :class="{ 'rotate-180': makersSubmenuOpen }"></i>
            </a>            
         <!-- Submenú de Fabricantes -->
            <div x-show="makersSubmenuOpen" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="ml-4 mt-1 space-y-1">
                <a href="{{route('admin.makers')}}" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white text-sm">
                    <i class="fas fa-list mr-2"></i> Ver Fabricantes
                </a>
                <a href="{{route('admin.makers.create')}}" class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white text-sm">
                    <i class="fas fa-plus mr-2"></i> Nuevo Fabricante
                </a>    
            </div>
        </div>
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-users mr-2"></i> Usuarios
        </a>
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-cog mr-2"></i> Configuración
        </a>
        <a href="{{route('admin.logout')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
        </a>
    </nav>
</aside>
