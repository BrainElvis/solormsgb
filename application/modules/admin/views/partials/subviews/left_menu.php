<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="profile">
            <div class="profile_info">
                <span><?php echo $this->lang->line('common_welcome')?>,&nbsp;<?php echo $admin; ?></span>
            </div>
        </div>
        <!-- /menu prile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="<?php echo site_url('admin/config');?>"><i class="fa fa-wrench"></i><?php echo $this->lang->line('setting_menu')?></a></li>
                    
                    <li><a><i class="fa fa-home"></i> <?php echo $this->lang->line('config_homepage'); ?><span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo site_url('admin/homepage/slider')?>"><?php echo $this->lang->line('config_homepage_slider')?></a> </li>
                            <li><a href="<?php echo site_url('admin/homepage/weserve')?>"><?php echo $this->lang->line('config_homepage_wesearve')?></a></li>
                            <li><a href="<?php echo site_url('admin/homepage/menucarousel')?>"><?php echo $this->lang->line('config_homepage_menucarousel')?></a></li>
                            <li><a href="<?php echo site_url('admin/homepage/ourfeatures')?>"><?php echo $this->lang->line('config_homepage_ourfeatures')?></a></li>
                            <li><a href="<?php echo site_url('admin/homepage/testimonials')?>"><?php echo $this->lang->line('config_homepage_testimonials')?></a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo site_url('admin/showcase')?>"><i class="fa fa-add"></i> <?php echo $this->lang->line('config_gallery')?></a></li>
                    <li><a href="<?php echo site_url('admin/inbox')?>"> <i class="fa fa-envelope-o"></i><?php echo $this->lang->line('config_inbox')?></a></li>
                    
                    <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="form.html">General Form</a>
                            </li>
                            <li><a href="form_advanced.html">Advanced Components</a>
                            </li>
                            <li><a href="form_validation.html">Form Validation</a>
                            </li>
                            <li><a href="form_wizards.html">Form Wizard</a>
                            </li>
                            <li><a href="form_upload.html">Form Upload</a>
                            </li>
                            <li><a href="form_buttons.html">Form Buttons</a>
                            </li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="general_elements.html">General Elements</a>
                            </li>
                            <li><a href="media_gallery.html">Media Gallery</a>
                            </li>
                            <li><a href="typography.html">Typography</a>
                            </li>
                            <li><a href="icons.html">Icons</a>
                            </li>
                            <li><a href="glyphicons.html">Glyphicons</a>
                            </li>
                            <li><a href="widgets.html">Widgets</a>
                            </li>
                            <li><a href="invoice.html">Invoice</a>
                            </li>
                            <li><a href="inbox.html">Inbox</a>
                            </li>
                            <li><a href="calender.html">Calender</a>
                            </li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="tables.html">Tables</a>
                            </li>
                            <li><a href="tables_dynamic.html">Table Dynamic</a>
                            </li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="chartjs.html">Chart JS</a>
                            </li>
                            <li><a href="chartjs2.html">Chart JS2</a>
                            </li>
                            <li><a href="morisjs.html">Moris JS</a>
                            </li>
                            <li><a href="echarts.html">ECharts </a>
                            </li>
                            <li><a href="other_charts.html">Other Charts </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="e_commerce.html">E-commerce</a>
                            </li>
                            <li><a href="projects.html">Projects</a>
                            </li>
                            <li><a href="project_detail.html">Project Detail</a>
                            </li>
                            <li><a href="contacts.html">Contacts</a>
                            </li>
                            <li><a href="profile.html">Profile</a>
                            </li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="page_404.html">404 Error</a>
                            </li>
                            <li><a href="page_500.html">500 Error</a>
                            </li>
                            <li><a href="plain_page.html">Plain Page</a>
                            </li>
                            <li><a href="login.html">Login Page</a>
                            </li>
                            <li><a href="pricing_tables.html">Pricing Tables</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>