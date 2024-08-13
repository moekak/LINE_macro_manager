export const fetchPostOperation = (data, url) => {


      return fetch(`${process.env.API_URL}/${url}`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }).then((response) => {
        if (!response.ok) {
          throw new Error("サーバーエラーが発生しました。");
        }
        return response.json();
      })
      .catch((error)=>{
  
    
        // エラーが発生した場合の処理
        sendErrorLog(error); // エラーログを送信
        redirectToErrorPage(); // エラーページにリダイレクト
  
      })
    };
export const fetchGetOperation = (url) => {


      return fetch(`${url}`, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      }).then((response) => {
        if (!response.ok) {
          throw new Error("サーバーエラーが発生しました。");
        }
        return response.json();
      })
      .catch((error)=>{

            console.log(error);
  

  
      })
    };