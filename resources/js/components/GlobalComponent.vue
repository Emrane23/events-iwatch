<template>
  <body>
    <!-- <div
      class="modal fade"
      id="editModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="editModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit This Card</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <input type="hidden" name="snoEdit" id="snoEdit" />
              <div class="form-group">
                <label for="name">Student Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="nameEdit"
                  name="nameEdit"
                />
              </div>

              <div class="form-group">
                <label for="desc">ID Card Number:</label>
                <input
                  class="form-control"
                  id="id_noEdit"
                  name="id_noEdit"
                  rows="3"
                />
              </div>
            </div>
            <div class="modal-footer d-block mr-auto">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Save changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div> -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <a class="navbar-brand" href="#"
        ><img src="assets/images/codingcush-logo.png" alt=""
      /></a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"
              >Home <span class="sr-only">(current)</span></a
            >
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input
            class="form-control mr-sm-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-success my-2 my-sm-0" type="submit">
            Search
          </button>
        </form>
      </div>
    </nav>

    <div class="container my-4 mt-4 mb-4">
      <button
        class="btn btn-info mr-1"
        type="button"
        @click="visible = !visible"
      >
        <i class="fa fa-plus"></i> Add New Card
      </button>
      <a href="id-card.php" class="btn btn-info">
        <i class="fa fa-address-card"></i> Generate ID Card
      </a>
      
      <div class="mt-4 mb-4" v-if="visible">
        <div class="card card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Participant Name</label>
                        <input
                        type="text"
                        name="name"
                        class="form-control"
                        id="inputCity"
                        />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Panel</label>
                        <select name="grade" class="form-control">
                            <option selected>Choose...</option>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                            <option value="4th">4th</option>
                            
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Address</label>
                        <input type="text" name="address" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Email Id</label>
                        <input type="text" name="email" class="form-control" />
                    </div>
                    
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="id_no">CIN Card</label>
                        <input class="form-control" id="id_no" name="id_no" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="phone">Phone Number</label>
                        <input class="form-control" id="phone" name="phone" />
                    </div>
                    <!-- <div class="form-group col-md-4">
                        <label for="photo">Photo</label>
                        <input type="file" name="image" />
                    </div> -->
                </div>
                <button type="submit" class="btn btn-info">
                    <i class="fa fa-plus"></i> Add Card
                </button>
            </form>
        </div>
    </div>
</div>
    
    <!-- <div class="container my-4">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>

    </div> -->
  </body>
</template>

<script>
export default {
  data() {
    return {
      visible: false,
    };
  },
};
</script>

<style>
</style>