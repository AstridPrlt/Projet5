<template>
    <div class="d-lg-flex">
        <form enctype="multipart/form-data" class="m-auto" style="width: 180px;">
            <div>
                <img v-show="!showAvatarPreview" :src="`./../public/storage/${authUser.avatar}`" alt="Photo de profil de l'utilisateur" class="img-thumbnail rounded-circle" style="width: 175px; height: 175px; min-width: 175px; min-height: 175px; position: relative; left: 50%; transform: translateX(-50%); object-fit: cover;">
                <img v-show="showAvatarPreview" :src="avatarPreview" class="img-thumbnail rounded-circle" style="width: 175px; height: 175px; min-width: 175px; min-height: 175px; position: relative; left: 50%; transform: translateX(-50%); object-fit: cover;">
            </div>
            <div class="w-100 text-center">
                <a v-show="readOnlyAvatar" type="button" style="color: teal;" @click="makeUpdateAvatar">Modifier ma photo</a>
                <div v-show="!readOnlyAvatar" class="custom-file">
                    <div class="custom-file text-left">
                        <input type="file" class="custom-file-input" id="custom-file" aria-describedby="inputGroupFileAddon01" @change="showPreview">
                        <label class="custom-file-label" for="custom-file" data-browse="Parcourir">Photo...</label>
                    </div>
                    <div class="d-flex justify-content-center m-2">
                        <button type="button" class="btn btn-outline-perso mx-2" @click="cancelUpdateAvatar">Annuler</button>
                        <button type="button" class="btn btn-perso mx-2" @click="updateAvatar">Valider</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="w-100">
            <form class="border rounded m-3 p-2">
                <div  class="form-group row mb-1" v-show="readOnlyInfo" >
                    <label for="staticName" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticName" v-model="authUser.name">
                    </div>
                </div>
                <div  class="form-group row mb-1" v-show="!readOnlyInfo">
                    <label for="name" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" v-model="authUser.name">
                    </div>
                </div>

                <div class="form-group row mb-1" v-show="readOnlyInfo">
                    <label for="staticJob" class="col-sm-2 col-form-label">Spécialité</label>
                    <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticJob" v-model="authUser.job">
                    </div>
                </div>
                <div class="form-group row mb-1" v-show="!readOnlyInfo">
                    <label for="job" class="col-sm-2 col-form-label">Spécialité</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="job" v-model="authUser.job" placeholder="Votre spécialité / job / domaine de prédilection">
                    </div>
                </div>


                <div class="form-group row mb-1" v-show="readOnlyInfo">
                    <label for="staticDesc" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                    <textarea type="text" readonly class="form-control-plaintext" id="staticDesc" v-model="authUser.user_description"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-1" v-show="!readOnlyInfo">
                    <label for="desc" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                    <textarea type="text" class="form-control" rows="5" id="desc" v-model="authUser.user_description" placeholder="Parlez-nous de vous et de ce que vous cherchez..."></textarea>
                    </div>
                </div>

                <button v-show="readOnlyInfo" type="button" class="btn btn-perso w-100 my-1" @click="makeUpdateInfo">Modifier mes infos</button>
                <button v-show="!readOnlyInfo" type="button" class="btn btn-perso w-100 my-1" @click="updateProfile">Enregistrer</button>
            </form>

            <form class="border rounded m-3 p-2">
                <div class="form-group row mb-1" v-show="readOnlyIds">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" required v-model="authUser.email">
                    </div>
                </div>
                <div class="form-group row mb-1" v-show="!readOnlyIds">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" required v-model="authUser.email">
                    </div>
                    <p class="w-100 text-center text-danger">{{ error_email }} </p>
                </div>

                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword">
                    </div>
                </div>

                <div class="form-group row mb-1">
                    <label for="inputPassword2" class="col-sm-2 col-form-label">Mot de passe (confirmation)</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword2">
                    </div>
                </div>

                <button v-show="readOnlyIds" type="button" class="btn btn-perso w-100 my-1" @click="makeUpdateIds">Modifier les identifiants</button>
                <button v-show="!readOnlyIds" type="button" class="btn btn-perso w-100 my-1" @click="updateIds">Enregistrer</button>
            </form>

            <div class="d-sm-flex border rounded m-3 p-2 text-center">
                <button class="m-1 w-50 text-uppercase btn btn-perso2">être invisible</button>
                <button class="m-1 w-50 text-uppercase btn btn-danger">Supprimer mon compte</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            authUser: {},

            readOnlyAvatar: true,
            avatarImage: null,
            avatarPreview:null,
            showAvatarPreview: false,

            readOnlyInfo: true,
            readOnlyIds: true,

            error_email : '',
        }
    },

    methods: {
        makeUpdateAvatar() {
            this.readOnlyAvatar = false;
        },
        cancelUpdateAvatar(){
            this.readOnlyAvatar = true;
            this.avatarImage = null;
            this.avatarPreview = null;
            this.showAvatarPreview = false;
        },
        makeUpdateInfo() {
            this.readOnlyInfo = false;
        },
        makeUpdateIds() {
            this.readOnlyIds = false;
        },

        showPreview(event) {
            this.avatarImage = event.target.files[0];
            let preview  = new FileReader();
            preview.readAsDataURL(this.avatarImage);
            preview.onload = event => {
                this.showAvatarPreview = true;
                this.avatarPreview = event.target.result;
            }
        },

        updateProfile() {
            axios.patch('http://localhost/Projet5/public/myProfile/' + this.authUser.id, {
                name: this.authUser.name,
                email: this.authUser.email,
                job: this.authUser.job,
                user_description: this.authUser.user_description
            })
            .then((response) => {
                console.log(response);
                this.readOnlyInfo = true;
                // this.readOnlyIds = true;
                })
            .catch(error => console.log(error))
        },

        updateIds() {
            axios.patch('http://localhost/Projet5/public/myProfileIds/' + this.authUser.id, {
                email: this.authUser.email,
            })
            .then((response) => {
                console.log(response);
                // this.readOnlyInfo = true;
                this.readOnlyIds = true;
                })
            .catch((error) => {
                // console.log(error);
                this.error_email = error.response.data.error.email})
        },

        refreshAvatar(avatar) {
            this.authUser.avatar = avatar.data;
        },

        updateAvatar() {
            let avatarData = new FormData();
            avatarData.append('avatar', this.avatarImage);
            axios.post('http://localhost/Projet5/public/myProfile/avatar/' + this.authUser.id, avatarData)
            .then((response) => {
                console.log(avatarData, response);
                this.refreshAvatar(response);
                this.showAvatarPreview = false;
                this.readOnlyAvatar = true;
                })
            .catch(error => console.log(error))
        }
    },

    created() {
        this.authUser.avatar = "avatars/defaultAvatar.png";
        axios.get('http://localhost/Projet5/public/myProfile')
        .then(response => this.authUser = response.data)
        .catch(error => console.log(error));
    },

}
</script>
