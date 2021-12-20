<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href=""><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            @can('view-admin-role')
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route("UserController.index") }}">list</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> Course<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route("CoursesController.index") }}">list</a>
                    </li>
                    <li>
                        <a href="{{ route("CourseController.create") }}">create</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('view-teacher-role')
            <li>
                <a href="#"><i class="fa fa-file-text-o fa-fw"></i> exam<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('ExamsController.showTeacherCourse') }}">Course list</a>
                    </li>
                </ul>
            </li>
                <li>
                    <a href="#"><i class="fa  fa-pencil-square-o fa-fw"></i> question<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('QuestionsController.showQuestions') }}">list</a>
                        </li>
                        <li>
                            <a href="#">Create <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{ route('QuestionsController.showDescriptive') }}">descriptive</a>
                                </li>
                                <li>
                                    <a href="{{ route('QuestionsController.showTest') }}">test</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>
                    </ul>

                </li>

            @endcan
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
