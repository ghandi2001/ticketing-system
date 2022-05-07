<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="x.html" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-home-2"></i>
                    <span class="nav-text">صفحه اصلی</span>
                </a>
            </li>
            <li>
                <a href="{{route('ticket.create')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-newspaper"></i>
                    <span class="nav-text">ثبت تیگت</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">مدیریت و تنظیمات تیکت ها</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('unit.index')}}">بخش</a></li>
                    <li><a href="{{route('ticket-type.index')}}">نوع های تیکت</a></li>
                    <li><a href="{{route('ticket-priority.index')}}">اولویت بندی های تیکت</a></li>
                </ul>
            </li>
            <li>
                <a class="ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-user-2"></i>
                    <span class="nav-text">مدیریت کاربران و دسترسی ها</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('user.index')}}">نمایش کاربران</a></li>
                    <li><a href="{{route('user.import.show')}}">وارد کردن کاربران</a></li>
                </ul>
            </li>
        </ul>
        <div class="copyright">
            <p>داشبورد مدیریت بلیط تیکسیا © 1399 کلیه حقوق محفوظ است</p>
            <p class="op5">ساخته شده با <i class="fa fa-heart"></i> توسط Amir</p>
        </div>
    </div>
</div>
