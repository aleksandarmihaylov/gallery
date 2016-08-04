<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Dashboard</small>
                        </h1>

                        <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $session->count; ?></div>
                                        <div>New Views</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                  <span class="pull-left">View Details</span> 
                               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-photo fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo Photo::count_all(); ?></div>
                                        <div>Photos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="photos.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Photos in Gallery</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo User::count_all(); ?>

                                        </div>

                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Users</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                      <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo Comment::count_all(); ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Comments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                        </div> <!--First Row-->

                        <div class="row">
                            
                            <div id="piechart" style="width: 900px; height: 500px;"></div>

                        </div>


                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->






            <?php

                            // find user by id
                            // $user = User::find_by_id(8);
                            // echo $user->username;

                            // find photo by id
                            // $photo = Photo::find_by_id(7);
                            // echo $photo->title;                            


                            // creating a user staticly   
                            
                            // $user = new User();  
                            // $user->username = "robi123";
                            // $user->password = "1234";
                            // $user->first_name = "Robert";
                            // $user->last_name = "Penchev";
                            // $user->create();

                            // example of finding an user by id and updating it
                            // $user = User::find_by_id(8);
                            // $user->username = "mikkelgroup";
                            // $user->password = 123;
                            // $user->update();

                            //exapmle of deleting an user by id 
                            // $user = User::find_by_id(15);
                            // $user->delete();

                            // using the save metheod check in db_objects.php what save does
                            // $user = User::find_by_id(2);
                            // $user->username = "robert";
                            // $user->save();

                            // finding all users

                            // $users = User::find_all();

                            // foreach ($users as $user) {
                            //     echo $user->username . " ";
                            // }


                            // finding all photos

                            // $photos = Photo::find_all();

                            // foreach ($photos as $photo) {
                            //     echo $photo->title . " ";
                            // }

                            // creating a photo staticly   
                            
                            // $photo = new Photo();  
                            // $photo->title = "Just some test title";
                            // $photo->size = "12";
                            // $photo->create();

                            // echo INCLUDES_PATH;
                            ?>

