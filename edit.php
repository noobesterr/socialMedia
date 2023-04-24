<?php
require 'bdd.php';
if (isset($_POST['create_post'])) {
    /**
     * insert script of editing a post
     */
}
// get post informations from bdd
include 'header.php';

?>
    <div class="main-content right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="row feed-body">
                    <div class="col-xl-8 col-xxl-9 col-lg-8">
                        <form method="post" class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3"
                              enctype="multipart/form-data">
                            <div class="card-body p-0">
                                <a href="#"
                                   class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i
                                            class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Edit
                                    Post</a>
                            </div>
                            <div class="card-body p-0 mt-3 position-relative">
                                <figure class="avatar position-absolute ms-2 mt-1 top-5"><img
                                            src="<?= $_SESSION['avatar'] ?>"
                                            alt="image"
                                            class="shadow-sm rounded-circle w30">
                                </figure>
                                <input name="title"
                                          class="bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                           placeholder="What's your post title" >
                                <textarea name="description"
                                          class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                          cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                            </div>
                            <div class="card-body d-flex p-0 mt-0">
                                <button type="submit" class="ms-auto btn btn-sm btn-primary text-white"
                                        id="dropdownMenu4"
                                        name="create_post">Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
include 'footer.php';
?>