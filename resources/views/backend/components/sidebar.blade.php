<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Rocker</h4>
				</div>
				<div class="toggle-icon ms-auto">
				</div>
			 </div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{ route('admin.dashboard') }}">
						<div class="parent-icon"><i class='bx bx-home-alt'></i></div>
						<div class="menu-title">Trang chủ</div>
					</a>
				</li>
				<li>
					<a href="{{ route('admin.account') }}">
						<div class="parent-icon"><i class="bx bx-user"></i>
						</div>
						<div class="menu-title">Tài khoản</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-book-open"></i></div>
						<div class="menu-title">Quản lý khóa học</div>
					</a>
					<ul>
						<li>
							<a href="{{ route('admin.course') }}">
								<div class="parent-icon"><i class="bx bx-book"></i></div>
								<div class="menu-title">Khóa học</div>
							</a>
						</li>
						<li>
							<a href="{{ route('admin.lesson') }}">
								<div class="parent-icon"><i class="bx bx-notepad"></i></div>
								<div class="menu-title">Bài giảng</div>
							</a>
						</li>
						<li>
							<a href="{{ route('admin.quiz') }}">
								<div class="parent-icon"><i class="bx bx-task"></i></div>
								<div class="menu-title">Bài kiểm tra</div>
							</a>
						</li>
					</ul>
				</li>
				
			</ul>
			<!--end navigation-->
		</div>