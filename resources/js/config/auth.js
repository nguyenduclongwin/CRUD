export const loginURL = '/oauth/token'
export const userURL = '/api/user'
export const authUser = {}

export async function login(username, password) {
  const authUser = {};
  let { status, data } = await axios({
    method: "post",
    url: loginURL,
    data: getData(username, password)
  });
  if (status === 200) {
    authUser.access_token = data.access_token;
    authUser.refresh_token = data.refresh_token;
    window.localStorage.setItem("authUser", JSON.stringify(authUser));
    let { data: user } = await axios({
      method: "get",
      url: userURL,
      headers: getHeader()
    });
    authUser.email = user.email;
    authUser.name = user.name;
    window.localStorage.setItem("authUser", JSON.stringify(authUser));
  }
}
// export async function getToken(username, password) {
//   let { status, data } = await axios({
//     method: "post",
//     url: loginURL,
//     data: {
//       'grant_type': 'password',
//       'client_id': '4',
//       'client_secret': 'vofoxEjrkCzo2Wj2wxtesXrmpa7ROPmDJ3sWoixN',
//       'username': username,
//       'password': password,
//       'scope': '*'
//     }
//   });
//   // console.log(data)
//   if (status === 200) {
//     authUser.access_token = data.access_token;
//     authUser.refresh_token = data.refresh_token;
//     window.localStorage.setItem("authUser", JSON.stringify(authUser));
//   }
// }
// export async function getUser() {
//   let { data } = await axios({
//     method: "get",
//     url: userURL,
//     headers: getHeader()
//   });
//   authUser.email = data.email;
//   authUser.name = data.name;
//   console.log(authUser)
//   window.localStorage.setItem("authUser", JSON.stringify(authUser));
// }

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