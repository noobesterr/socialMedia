<?php
include "header.php";
require 'SQLWorker.php';
$sqlWorker = new SQLWorker();
$error = null;
if (isset($_POST['create_post'])) {
    $post = $sqlWorker->storePost($_SESSION['id'], $_POST, $_FILES);
    $_POST = array();
}

if (isset($_POST['update_profile'])) {
    $_POST['avatar'] = $_SESSION['avatar'];
    if (isset($_FILES['avatar']) && $_FILES['avatar']['name'] != ""){
        $tmp_name = $_FILES["avatar"]["tmp_name"];
        $name = rand().'.'.explode('.',$_FILES["avatar"]["name"])[1];
        if (move_uploaded_file($tmp_name, "uploads/avatars/$name")) {
            $_POST['avatar'] = "uploads/avatars/".$name;
        }
    }
    $profile = $sqlWorker->updateProfile($_SESSION['id'],$_POST);
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['avatar'] = $_POST['avatar'];
    $_POST = array();
}

if (isset($_POST['update_password'])) {
    $user =  $sqlWorker->getUserByMail($_SESSION['email']);
    if ($user){
        if (password_verify($_POST['current-password'],$user->password)){
            $_POST['new-password'] = password_hash($_POST['new-password'],PASSWORD_DEFAULT);
            $password = $sqlWorker->updatePassword($_SESSION['id'],$_POST);
        }
    }
    $_POST = array();
}
$my_posts = $sqlWorker->getUserPosts($_SESSION['id']);
?>
    <div class="middle-sidebar-left">
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100 border-0 p-0 bg-white shadow-xss rounded-xxl">

                    <div class="card-body h250 p-0 rounded-xxl overflow-hidden m-3"><img src="images/u-bg.jpg"
                                                                                         alt="image"></div>
                    <div class="card-body p-0 position-relative">
                        <figure class="avatar position-absolute w100 z-index-1" style="top:-40px; left: 30px;"><img
                                    src="<?= $_SESSION['avatar'] ?>" alt="image"
                                    class="float-right p-1 bg-white rounded-circle w-100"></figure>
                        <h4 class="fw-700 font-sm mt-2 mb-lg-5 mb-4 pl-15"><?= $_SESSION['name'] ?> <span
                                    class="fw-500 font-xssss text-grey-500 mt-1 mb-3 d-block"><?= $_SESSION['email'] ?></span>
                        </h4>
                    </div>

                    <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                        <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab"
                            role="tablist">
                            <li class="active list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active"
                                        href="#my-posts" data-toggle="tab">My posts</a></li>
                            <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#my-informations" data-toggle="tab">My informations</a></li>
                            <li class="list-inline-item me-5"><a
                                        class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                        href="#my-password" data-toggle="tab">My password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-xxl-9 col-lg-8 tab-content">
                <div id="my-posts" class="tab-pane fade show active ">
                    <form method="post" class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3"
                          enctype="multipart/form-data">
                        <?php
                        if (isset($post) && $post) {
                            echo '<badge class="badge badge-success w-100">Post successfully created</badge>';
                        } else if (isset($post) && !$post) {
                            echo '<badge class="badge badge-danger w-100">Error when trying to create post, try later</badge>';
                        }
                        ?>
                        <div class="card-body p-0">
                            <a href="#"
                               class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i
                                        class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Create
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
                                   placeholder="What's your post title">
                            <textarea name="description"
                                      class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                      cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                        </div>
                        <div class="card-body d-flex p-0 mt-0">
                            <label for="post-photos"
                                   class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i
                                        class="font-md text-success feather-image me-2"></i><span class="d-none-xs">Photos</span></label>
                            <input type="file" name="photos[]" class="d-none" id="post-photos" multiple>
                            <button type="submit" class="ms-auto btn btn-sm btn-primary text-white"
                                    id="dropdownMenu4"
                                    name="create_post">Save
                            </button>
                        </div>
                    </form>
                    <?php
                    foreach ($my_posts as $post) {
                        ?>
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                            <div class="card-body p-0 d-flex">
                                <figure class="avatar me-3"><img
                                            src="<?= $post['avatar'] != null ? $post['avatar'] : "images/profile-2.png" ?>"
                                            alt="image"
                                            class="shadow-sm rounded-circle w45"></figure>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1"><?= $post['name'] ?> <span
                                            class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"><?= $post['created_at'] ?></span>
                                </h4>
                                <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown"
                                   aria-expanded="false"><i
                                            class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                                     aria-labelledby="dropdownMenu2" style="margin: 0px;">
                                    <?php
                                    if ($_SESSION['id'] == $post['user_id']) { ?>
                                        <a href="javascript:void" class="card-body p-0 d-flex delete-post"
                                           data-id="<?= $post['id'] ?>">
                                            <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Delete <span
                                                        class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Delete your post</span>
                                            </h4>
                                        </a>
                                        <a href="javascript:void" class="card-body p-0 d-flex edit-post mt-2"
                                           data-id="<?= $post['id'] ?>">
                                            <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4 ">Edit<span
                                                        class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Update your post informations</span>
                                            </h4>
                                        </a>
                                        <?php
                                    } else { ?>
                                    <a href="javascript:void" class="card-body p-0 d-flex report-post"
                                       data-id="<?= $post['id'] ?>">
                                        <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4 ">Report <span
                                                    class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Report the post to the administration</span>
                                        </h4>
                                        <a/>
                                        <?php
                                        } ?>
                                </div>
                            </div>
                            <div class="card-body p-0 me-lg-5">
                                <h4 class="fw-800"><?= $post['title'] ?></h4>
                                <p class="fw-500 text-grey-500 lh-26 font-xssss w-100"><?= $post['description'] ?></p>
                            </div>
                            <div class="card-body d-block p-0">
                                <div class="row ps-2 pe-2">
                                    <?php foreach (json_decode($post['attachments']!=null?$post['attachments']:"{}") as $attachment) { ?>
                                        <div class="col-xs-4 col-sm-4 p-1"><a href="uploads/posts/<?= $attachment ?>"
                                                                              data-lightbox="roadtrip"><img
                                                        src="uploads/posts/<?= $attachment ?>" class="rounded-3 w-100"
                                                        alt="image"></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="card-body d-flex p-0 mt-3">
                                <a href="javascript:void" data-id="<?= $post['id'] ?>" data-reaction="like"
                                   class="react-post emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2">
                                    <i class="feather-thumbs-up  <?= $post['user_reaction'] == "like" ? 'text-white bg-primary-gradiant' : '' ?> me-1 btn-round-xs font-xss"></i>
                                    <span class="like_count me-2"><?= $post['like_count'] ?></span> Like</a>
                                <a href="javascript:void" data-id="<?= $post['id'] ?>" data-reaction="dislike"
                                   class=" react-post emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2">
                                    <i class="feather-thumbs-down  <?= $post['user_reaction'] == "dislike" ? 'text-white bg-red-gradiant' : '' ?> me-2 btn-round-xs font-xss"></i><span
                                            class="dislike_count me-2"><?= $post['dislike_count'] ?></span>
                                    Dislike</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div id="my-informations" class="tab-pane fade card w-100 border-0 bg-white shadow-xs my-4">
                    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Account Details</h4>
                    </div>
                    <div class="card-body p-lg-5 p-4 w-100 border-0 ">
                        <form method="post" enctype="multipart/form-data">
                            <?php
                            if (isset($profile) && $profile) {
                                echo '<badge class="badge badge-success w-100">Profile successfully updated</badge>';
                            } else if (isset($profile) && !$profile) {
                                echo '<badge class="badge badge-danger w-100">Error when trying to update profile, try later</badge>';
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">user Name</label>
                                        <input type="text" class="form-control" name="name" value="<?= $_SESSION['name'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Email</label>
                                        <input type="text" class="form-control" name="email" value="<?= $_SESSION['email'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="card mt-3 border-0">
                                        <div class="card-body d-flex justify-content-between align-items-end p-0">
                                            <div class="form-group mb-0 w-100">
                                                <input type="file" name="avatar" id="file" class="input-file">
                                                <label for="file"
                                                       class="rounded-3 text-center bg-white btn-tertiary js-labelFile p-4 w-100 border-dashed">
                                                    <i class="ti-cloud-down large-icon me-3 d-block"></i>
                                                    <span class="js-fileName">Drag and drop or click to replace avatar</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="update_profile" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div id="my-password" class="tab-pane fade card w-100 border-0 bg-white shadow-xs my-4">
                    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Change Password</h4>
                    </div>
                    <div class="card-body p-lg-5 p-4 w-100 border-0">
                        <form method="post">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-gorup">
                                        <label class="mont-font fw-600 font-xssss">Current Password</label>
                                        <input type="text" name="current-password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <div class="form-gorup">
                                        <label class="mont-font fw-600 font-xssss">Change Password</label>
                                        <input type="text" name="new-password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-gorup">
                                        <label class="mont-font fw-600 font-xssss">Confirm Change Password</label>
                                        <input type="text" name="confirm-password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-0">
                                    <button type="submit" name="update_password" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Save</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>