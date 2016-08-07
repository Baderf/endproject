<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="#" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="users_list/newUser" class="btn btn-default btn-lg btn-back btn-self">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new User
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_users">
        <h3><?php echo "Users of ". $data['event_infos']['name'];?></h3>
        <span class="page_quader"></span>
    </div>



    <!-- /.content-section-a -->


    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 left_filter_area spec_users">

            <ul class="list">
                <li>
                    <a href="#">All user</a>
                </li>

                <li>
                    <a href="#about">Commited</a>
                </li>

                <li>
                    <a href="#services">Cancelled</a>
                </li>

                <li>
                    <a href="#contact">No feedback</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 my_events_list">

            <table class="table table-inverse table-striped">
                <thead class="thead-inverse">
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                <tr>

                    <td>Mark</td>
                    <td>Otto</td>

                    <td>-</td>
                    <td>@mdo</td>
                </tr>
                <tr>

                    <td>Jacob</td>
                    <td>Thornton</td>

                    <td>23.12.2016</td>
                    <td>@fat</td>
                </tr>
                <tr>

                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>23.12.2016</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>






        </div>

    </div>

    <!-- /.container -->

</div>