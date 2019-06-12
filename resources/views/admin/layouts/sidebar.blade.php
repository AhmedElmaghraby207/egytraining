<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if((App\Admin::first()->image) != null)
                    <img width="50" height="50" src="{{asset(App\Admin::first()->image)}}" class="img-circle" alt="User Image">
                @else
                    <img src="{{asset('http://via.placeholder.com/50x50')}}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{App\Admin::first()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> متصل</a>
                <a href="{{route('profile.index')}}"><i class="fa fa-user"></i> الصفحة الشخصية</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li>
                <a href="{{url('/home')}}">
                    <i class="fa fa-dashboard"></i> <span>الموقع (Courses)</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li>
                <a href="{{url('/admin/home')}}">
                    <i class="fa fa-dashboard"></i> <span>الرئيسية</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>المدربين</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('coaches.index')}}"><i class="fa fa-circle-o"></i> عرض المدربين</a></li>
                    <li><a href="{{route('coaches.create')}}"><i class="fa fa-circle-o"></i> إضافة مدرب</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>المتدربين</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('trainers.index')}}"><i class="fa fa-circle-o"></i> عرض المتدربين</a></li>
                    <li><a href="{{route('trainers.create')}}"><i class="fa fa-circle-o"></i> إضافة متدرب</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>اقسام الكورسات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin-categories.index')}}"><i class="fa fa-circle-o"></i> عرض الاقسام</a></li>
                    <li><a href="{{route('admin-categories.create')}}"><i class="fa fa-circle-o"></i> إضافة قسم</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>الدورات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin-courses.index')}}"><i class="fa fa-circle-o"></i>عرض الدورات</a></li>
                    <li><a href="{{route('admin-courses.create')}}"><i class="fa fa-circle-o"></i>إضافة دورة</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>الدروس</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin-lectures.index')}}"><i class="fa fa-circle-o"></i>عرض الدروس</a></li>
                    <li><a href="{{route('admin-lectures.create')}}"><i class="fa fa-circle-o"></i>إضافة درس</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>الشهادات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin-certificates.index')}}"><i class="fa fa-circle-o"></i>عرض الشهادات</a></li>
                    <li><a href="{{route('admin-certificates.create')}}"><i class="fa fa-circle-o"></i>إضافة شهادة</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>الاختبارات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin-tests.index')}}"><i class="fa fa-circle-o"></i>عرض الاختبارات</a></li>
                    <li><a href="{{route('admin-tests.create')}}"><i class="fa fa-circle-o"></i>إضافة إختبار</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>الاهتمامات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('interests.index')}}"><i class="fa fa-circle-o"></i> عرض الاهتمامات</a></li>
                    <li><a href="{{route('interests.create')}}"><i class="fa fa-circle-o"></i> إضافة إهتمام</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>التنويهات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin-alerts.index')}}"><i class="fa fa-circle-o"></i> عرض التنويهات</a></li>
                    <li><a href="{{route('admin-alerts.create')}}"><i class="fa fa-circle-o"></i> إضافة تنويه</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>الرسائل</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin-messages.index')}}"><i class="fa fa-circle-o"></i> عرض الرسائل</a></li>
                    <li><a href="{{route('admin-messages.create')}}"><i class="fa fa-circle-o"></i> إضافة رسالة</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>التعليقات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin-comments.index')}}"><i class="fa fa-circle-o"></i> عرض التعليقات</a></li>
                    <li><a href="{{route('admin-comments.create')}}"><i class="fa fa-circle-o"></i> إضافة تعليق</a></li>
                    <li><a href="{{route('admin-replies.index')}}"><i class="fa fa-circle-o"></i> عرض الردود على التعليقات</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>قالوا عنا</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('sayings.index')}}"><i class="fa fa-circle-o"></i> عرض الاقاويل</a></li>
                    <li><a href="{{route('sayings.create')}}"><i class="fa fa-circle-o"></i> إضافة قول جديد</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('contacts.index')}}">
                    <i class="fa fa-dashboard"></i> <span>رسائل التواصل</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>الاسئلة الشائعة</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('questions.index')}}"><i class="fa fa-circle-o"></i> عرض الاسئلة</a></li>
                    <li><a href="{{route('questions.create')}}"><i class="fa fa-circle-o"></i> إضافة سؤال</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>الدول</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('countries.index')}}"><i class="fa fa-circle-o"></i> عرض الدول</a></li>
                    <li><a href="{{route('countries.create')}}"><i class="fa fa-circle-o"></i> إضافة دولة</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('settings.index')}}">
                    <i class="fa fa-dashboard"></i> <span>الاعدادات</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>




        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
