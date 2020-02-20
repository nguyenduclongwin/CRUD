export const loginURL = '/oauth/token'
export const userURL = '/api/user'

export const getHeader = function () {
    const tokenData = JSON.parse(window.localStorage.getItem('authUser'))
    const headers = {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + tokenData.access_token
    };
    return headers;
}
export const getData = function (username,password) {
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

//config API
export const showArticle = "api/article";
export const addArticle = "api/article";
export const editArticle = function(id){
    const url='api/article/'+id;
    return url
}
export const delArticle = function(id){
    const url="api/article/" + id;
    return url;
}
