<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">

            <li>
                <a href="{{route('home.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-home-2"></i>
                    <span class="nav-text">صفحه اصلی</span>
                </a>
            </li>

            @if(checkAnyAccessToTemplate(['add ticket','see ticket','see tickets','close ticket']))
                <li>
                    <a class="ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-newspaper"></i>
                        <span class="nav-text">امور مربوط به تیکت ها</span>
                    </a>
                    <ul aria-expanded="false">
                        @if(checkAnyAccessToTemplate('add ticket'))
                            <li><a href="{{route('ticket.create')}}">ثبت تیکت</a></li>
                        @endif
                        @if(checkAnyAccessToTemplate(['see tickets','see ticket']))
                            <li><a href="{{route('ticket.index')}}">مشاهده تیکت ها</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(checkAnyAccessToTemplate('make report'))
                <li>
                    <a href="{{route('report.wizard.show')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-book"></i>
                        <span class="nav-text">گزارش گیر</span>
                    </a>
                </li>
            @endif

            @if(checkAnyAccessToTemplate(['see units','see ticketTypes','see ticketPriorities','see readyAnswers']))
                <li>
                    <a class="ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">مدیریت و تنظیمات تیکت ها</span>
                    </a>
                    <ul aria-expanded="false">
                        @if(checkAnyAccessToTemplate('see units'))
                            <li><a href="{{route('unit.index')}}">بخش</a></li>
                        @endif
                        @if(checkAnyAccessToTemplate('see ticketTypes'))
                            <li><a href="{{route('ticket-type.index')}}">نوع های تیکت</a></li>
                        @endif
                        @if(checkAnyAccessToTemplate('see ticketPriorities'))
                            <li><a href="{{route('ticket-priority.index')}}">اولویت بندی های تیکت</a></li>
                        @endif
                        @if(checkAnyAccessToTemplate('see readyAnswers'))
                            <li><a href="{{route('answer.index')}}">جواب های آماده برای تیکت ها</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(checkAnyAccessToTemplate(['see users','import users']))
                <li>
                    <a class="ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-user-2"></i>
                        <span class="nav-text">مدیریت کاربران و دسترسی ها</span>
                    </a>
                    <ul aria-expanded="false">
                        @if(checkAnyAccessToTemplate('see users'))
                            <li><a href="{{route('user.index')}}">نمایش کاربران</a></li>
                        @endif
                        @if(checkAnyAccessToTemplate('import users'))
                            <li><a href="{{route('user.import.show')}}">وارد کردن کاربران</a></li>
                        @endif
                        @if(checkAnyAccessToTemplate('see roles'))
                            <li><a href="{{route('role.index')}}">نقش ها</a></li>
                        @endif
                    </ul>
                </li>
            @endif
        </ul>

        <div class="copyright">
            <p>داشبورد مدیریت بلیط تیکسیا © 1399 کلیه حقوق محفوظ است</p>
            <p class="op5">ساخته شده با <i class="fa fa-heart"></i> توسط Amir</p>
        </div>

    </div>
</div>
