<header class="banner">
  @if (has_nav_menu('primary_navigation'))
    <nav
      class="nav-primary flex items-center justify-between flex-wrap p-6 fixed w-full z-10 top-0"
      aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}"
      x-data="{ isOpen: false }"
      @keydown.escape="isOpen = false"
      :class="{ 'shadow-lg bg-indigo-900' : isOpen , 'bg-gray-800' : !isOpen}"
    >

      <div class="flex items-center flex-shrink-0 text-white mr-6">
        <a
          class="text-white no-underline hover:text-white hover:no-underline"
          href="#"
        >
          <span class="text-2xl pl-2"
          ><i class="em em-grinning"></i> Brand McBrandface</span
          >
        </a>
      </div>

      <!--Toggle button (hidden on large screens)-->
      <button
        @click="isOpen = !isOpen"
        type="button"
        class="block lg:hidden px-2 text-gray-500 hover:text-white focus:outline-none focus:text-white"
        :class="{ 'transition transform-180': isOpen }"
      >
        <svg
          class="h-6 w-6 fill-current"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
        >
          <path
            x-show="isOpen"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"
          />
          <path
            x-show="!isOpen"
            fill-rule="evenodd"
            d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
          />
        </svg>
      </button>
      <div
        class="w-full flex-grow lg:flex lg:items-center lg:w-auto lg:justify-end"
        :class="{ 'block shadow-3xl': isOpen, 'hidden': !isOpen }"
        @click.away="isOpen = false"
        x-show.transition="true"
      >
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav pt-6 lg:pt-0 list-reset lg:flex justify-end flex-1 items-center', 'echo' => false]) !!}
      </div>

      <div
        class="header-buttons flex"
        :class="{ 'block shadow-3xl': isOpen, 'hidden': !isOpen }"
      >
        <div class="neo-button">
          <a class="effect" href="#">
            book
          </a>
        </div>
        <div class="neo-button">
          <a class="effect" href="#">
            appointment
          </a>
        </div>
      </div>
    </nav>
  @endif


</header>
