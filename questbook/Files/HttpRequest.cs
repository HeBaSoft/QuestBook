using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;
using System.Net;
using System.Windows.Forms;

namespace QuestBookGateway {

    class HttpRequest {

        public static string GetPost(string Url, params string[] postdata) {
            string result = string.Empty;
            string data = string.Empty;

            if (postdata.Length % 2 != 0) {
                throw new Exception("Parameter postdata has to contain pairs of data!");
            }

            for (int i = 0; i < postdata.Length; i += 2) {
                data += string.Format("&{0}={1}", postdata[i], postdata[i + 1]);
            }

            data = data.Remove(0, 1);

            byte[] bytesarr = Encoding.UTF8.GetBytes(data);
            WebRequest request = WebRequest.Create(Url);

            request.Method = "POST";
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = bytesarr.Length;

            System.IO.Stream streamwriter = request.GetRequestStream();
            streamwriter.Write(bytesarr, 0, bytesarr.Length);
            streamwriter.Close();

            WebResponse response = request.GetResponse();
            streamwriter = response.GetResponseStream();

            System.IO.StreamReader streamread = new System.IO.StreamReader(streamwriter);
            result = streamread.ReadToEnd();
            streamread.Close();

            return result;
        }
    }
}
