
   <!--<div class="menu-btn">
     <i class="fas fa-bars"></i>
   </div>-->
   
   <div class="side-bar">
   <img src="{{asset('assets/img/vcp.png')}}" style="position: relative; width: 100px; left: 80px; top: 30px;">
     <div class="menu">
       <div class="item {{Route::is('home') ? 'active' : '' }}"><a href="{{ route('home') }}"><i class="fas fa-desktop"></i>Dashboard</a></div>
       <div class="item"><a href="{{ route('pos') }}"><i class="fa-solid fa-cash-register"></i> POS</a></div>
       <div class="item">
         <a class="sub-btn {{Route::is(['add_employee', 'list_employees']) ? 'active' : '' }}"><i class="fa-solid fa-user"></i>Employees<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
           <a href="{{ route('add_employee') }}" class="sub-item {{Route::is('add_employee') ? 'active' : '' }}"><i class="fa-solid fa-user-plus"></i> Add Employee</a>
           <a href="{{ route('list_employees')}}" class="sub-item {{Route::is('list_employees') ? 'active' : '' }}"><i class="fa-solid fa-users-line"></i> List of Employees</a>
         </div>
       </div>
       <div class="item">
         <a class="sub-btn {{Route::is(['add_products', 'brands', 'list_product']) ? 'active' : '' }}"><i class="fa-solid fa-cart-shopping cus-icon"></i>Products<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
           <a href="{{ route('add_products') }}" class="sub-item {{Route::is('add_products') ? 'active' : '' }}"><i class="fa-solid fa-cart-plus"></i> Add Products</a>
           <a href="{{ route('brands') }}" class="sub-item {{Route::is('brands') ? 'active' : '' }}"><i class="fa-solid fa-list"></i> Product Brands</a>
           <a href="{{ route('list_product') }}" class="sub-item {{Route::is('list_product') ? 'active' : '' }}"><i class="fa-solid fa-table-list"></i> List of Products</a>
         </div>
       </div>
       <div class="item">
         <a class="sub-btn {{Route::is(['add_customer', 'list_customer']) ? 'active' : '' }}"><i class="fa-sharp fa-solid fa-users"></i>Customer<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
           <a href="{{ route('add_customer') }}" class="sub-item {{Route::is('add_customer') ? 'active' : '' }}"><i class="fa-solid fa-user-plus"></i> Add Customer</a>
           <a href="{{ route('list_customer') }}" class="sub-item {{Route::is('list_customer') ? 'active' : '' }}"><i class="fa-solid fa-users-line"></i> List of Customers</a>
         </div>
       </div>
       <div class="item  {{Route::is('transaction') ? 'active' : '' }}"><a href="{{ route('transaction') }}"><i class="fa-solid fa-clock-rotate-left"></i> Transaction History</a></div>
       <div class="item">
         <a class="sub-btn {{Route::is('user') ? 'active' : '' }}"><i class="fas fa-cogs"></i>Settings<i class="fas fa-angle-right dropdown"></i></a>
         <div class="sub-menu">
           <a href="{{ route('user') }}" class="sub-item {{Route::is('user') ? 'active' : '' }}"><i class="fa-solid fa-user"></i> POS Accounts</a>
         </div>
       </div>
       <div class="item {{Route::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}"><i class="fas fa-info-circle"></i>About</a></div>
     </div>
   </div>
   @section('script')
   <script >
   $(document).ready(function(){
     //jquery for toggle sub menus
     $('.sub-btn').click(function(){
       $(this).next('.sub-menu').toggleClass('show');
       $(this).find('.dropdown').toggleClass('rotate');
     });

     //jquery for expand and collapse the sidebar
     //$('.menu-btn').click(function(){
       //$(this).toggleClass('click');
       //$('.side-bar').toggleClass('show');
    // });
   });
   </script>
    @endsection