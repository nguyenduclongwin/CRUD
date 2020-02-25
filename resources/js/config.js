//config url
export const loginURL = '/oauth/token'
export const userURL = '/api/user'
export const addArticle = "api/article";
export const usersURL = '/api/users'
// export const exportURL = '/api/export-article'

export const exportURL = function (page) {
    const url = 'api/export-article/' + page;
    return url;
}
export const editArticle = function (id) {
    const url = 'api/article/' + id;
    return url
}
export const delArticle = function (id) {
    const url = "api/article/" + id;
    return url;
}


//config login
export const getHeader = function () {
    const tokenData = JSON.parse(window.localStorage.getItem('authUser'))
    const headers = {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + tokenData.access_token
    };
    return headers;
}
export const getData = function (username, password) {
    const datas = {
        'grant_type': 'password',
        'client_id': '4',
        'client_secret': 'vofoxEjrkCzo2Wj2wxtesXrmpa7ROPmDJ3sWoixN',
        'username': username,
        'password': password,
        'scope': '*'
    }
    return datas
}


