<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Main Menu</span></li>

                <li class="submenu active">
                    <a href="#"><i class="feather-grid"></i> <span>Dashboard</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('admin/dashboard') }}">Admin Dashboard</a></li>
                        <li><a href="{{ url('teacher/dashboard') }}" class="active">Teacher Dashboard</a></li>
                        <li><a href="{{ url('student/dashboard') }}">Student Dashboard</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-graduation-cap"></i><span> Students</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('students') }}">Student List</a></li>
                        <li><a href="{{ url('students/view') }}">Student View</a></li>
                        <li><a href="{{ url('students/create') }}">Student Add</a></li>
                        <li><a href="{{ url('students/edit') }}">Student Edit</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i><span> Teachers</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('teachers') }}">Teacher List</a></li>
                        <li><a href="{{ url('teachers/view') }}">Teacher View</a></li>
                        <li><a href="{{ url('teachers/create') }}">Teacher Add</a></li>
                        <li><a href="{{ url('teachers/edit') }}">Teacher Edit</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-building"></i><span> Departments</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('departments') }}">Department List</a></li>
                        <li><a href="{{ url('departments/create') }}">Department Add</a></li>
                        <li><a href="{{ url('departments/edit') }}">Department Edit</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i><span> Subjects</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('subjects') }}">Subject List</a></li>
                        <li><a href="{{ url('subjects/create') }}">Subject Add</a></li>
                        <li><a href="{{ url('subjects/edit') }}">Subject Edit</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i><span> Invoices</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('invoices') }}">Invoices List</a></li>
                        <li><a href="{{ url('invoices/grid') }}">Invoices Grid</a></li>
                        <li><a href="{{ url('invoices/create') }}">Add Invoices</a></li>
                        <li><a href="{{ url('invoices/edit') }}">Edit Invoices</a></li>
                        <li><a href="{{ url('invoices/view') }}">Invoices Details</a></li>
                        <li><a href="{{ url('invoices/settings') }}">Invoices Settings</a></li>
                    </ul>
                </li>

                <li class="menu-title"><span>Management</span></li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i><span> Accounts</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('fees-collections') }}">Fees Collection</a></li>
                        <li><a href="{{ url('expenses') }}">Expenses</a></li>
                        <li><a href="{{ url('salary') }}">Salary</a></li>
                        <li><a href="{{ url('fees-collections/create') }}">Add Fees</a></li>
                        <li><a href="{{ url('expenses/create') }}">Add Expenses</a></li>
                        <li><a href="{{ url('salary/create') }}">Add Salary</a></li>
                    </ul>
                </li>

                <li><a href="{{ url('holiday') }}"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a></li>
                <li><a href="{{ url('fees') }}"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a></li>
                <li><a href="{{ url('exam') }}"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a></li>
                <li><a href="{{ url('event') }}"><i class="fas fa-calendar-day"></i> <span>Events</span></a></li>
                <li><a href="{{ url('time-table') }}"><i class="fas fa-table"></i> <span>Time Table</span></a></li>
                <li><a href="{{ url('library') }}"><i class="fas fa-book"></i> <span>Library</span></a></li>

                <li class="submenu">
                    <a href="#"><i class="fa fa-newspaper"></i><span> Blogs</span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('blogs') }}">All Blogs</a></li>
                        <li><a href="{{ url('blogs/create') }}">Add Blog</a></li>
                        <li><a href="{{ url('blogs/edit') }}">Edit Blog</a></li>
                    </ul>
                </li>

                <li><a href="{{ url('settings') }}"><i class="fas fa-cog"></i> <span>Settings</span></a></li>

                <li class="menu-title"><span>Pages</span></li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-shield-alt"></i><span> Authentication </span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('login') }}">Login</a></li>
                        <li><a href="{{ url('register') }}">Register</a></li>
                        <li><a href="{{ url('forgot-password') }}">Forgot Password</a></li>
                        <li><a href="{{ url('error-404') }}">Error Page</a></li>
                    </ul>
                </li>

                <li><a href="{{ url('blank-page') }}"><i class="fas fa-file"></i> <span>Blank Page</span></a></li>

                <li class="menu-title"><span>Others</span></li>

                <li><a href="{{ url('sports') }}"><i class="fas fa-baseball-ball"></i> <span>Sports</span></a></li>
                <li><a href="{{ url('hostel') }}"><i class="fas fa-hotel"></i> <span>Hostel</span></a></li>
                <li><a href="{{ url('transport') }}"><i class="fas fa-bus"></i> <span>Transport</span></a></li>

                <li class="menu-title"><span>UI Interface</span></li>

                <li class="submenu">
                    <a href="#"><i class="fab fa-get-pocket"></i><span>Base UI </span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        @foreach (['alerts', 'accordions', 'avatar', 'badges', 'buttons', 'buttongroup', 'breadcrumbs', 'cards', 'carousel', 'dropdowns', 'grid', 'images', 'lightbox', 'media', 'modal', 'offcanvas', 'pagination', 'popover', 'progress', 'placeholders', 'rangeslider', 'spinners', 'sweetalerts', 'tab', 'toastr', 'tooltip', 'typography', 'video'] as $ui)
                            <li><a href="{{ url($ui) }}">{{ ucfirst(str_replace('-', ' ', $ui)) }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i data-feather="box"></i><span>Elements </span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        @foreach (['ribbon', 'clipboard', 'drag-drop', 'rating', 'text-editor', 'counter', 'scrollbar', 'notification', 'stickynote', 'timeline', 'horizontal-timeline', 'form-wizard'] as $el)
                            <li><a href="{{ url($el) }}">{{ ucfirst(str_replace('-', ' ', $el)) }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i data-feather="bar-chart-2"></i><span> Charts </span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        @foreach (['chart-apex', 'chart-js', 'chart-morris', 'chart-flot', 'chart-peity', 'chart-c3'] as $chart)
                            <li><a href="{{ url($chart) }}">{{ ucfirst(str_replace('-', ' ', $chart)) }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i data-feather="award"></i> <span>Icons </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        @foreach (['icon-fontawesome', 'icon-feather', 'icon-ionic', 'icon-material', 'icon-pe7', 'icon-simpleline', 'icon-themify', 'icon-weather', 'icon-typicon', 'icon-flag'] as $icon)
                            <li><a href="{{ url($icon) }}">{{ ucfirst(str_replace('-', ' ', $icon)) }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-columns"></i><span> Forms </span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        @foreach (['form-basic-inputs', 'form-input-groups', 'form-horizontal', 'form-vertical', 'form-mask', 'form-validation'] as $form)
                            <li><a href="{{ url($form) }}">{{ ucfirst(str_replace('-', ' ', $form)) }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-table"></i><span> Tables </span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('tables-basic') }}">Basic Tables</a></li>
                        <li><a href="{{ url('data-tables') }}">Data Table</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fas fa-code"></i><span>Multi Level</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><span>Level 1</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                <li class="submenu">
                                    <a href="javascript:void(0);"><span> Level 2</span> <span
                                            class="menu-arrow"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);"><span>Level 1</span></a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
