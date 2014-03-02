
#include "curl_handler.h"


size_t write_data(void *ptr, size_t size, size_t nmemb, CurlResponse *data) {

    size_t index = data->size;
    size_t n = (size * nmemb);
    char* tmp;

    data->size += (size * nmemb);

    tmp = (char*)realloc(data->data, data->size + 1); /* +1 for '\0' */

    if(tmp) {
        data->data = tmp;
    } else {
        if(data->data) {
            free(data->data);
        }
        fprintf(stderr, "Failed to allocate memory.\n");
        return 0;
    }

    memcpy((data->data + index), ptr, n);
    data->data[data->size] = '\0';

    return size * nmemb;
}

CurlResponse handle_curl(const char *url, const char *post_fields) {

    CurlResponse data;
    data.size = 0;
    data.data = (char*)malloc(4096); /* reasonable size initial buffer */

    if(data.data == NULL) {
        fprintf(stderr, "Failed to allocate memory.\n");
        abort();
    }

    data.data[0] = '\0';
    
    CURL *curl;
    CURLcode res;

    curl = curl_easy_init();

    if (curl == NULL) {
        printf("curl_easy_init\n");
        abort();
    }

    curl_easy_setopt(curl, CURLOPT_URL, url);
    curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, write_data);
    curl_easy_setopt(curl, CURLOPT_WRITEDATA, &data);
    
    if(post_fields != NULL)
        curl_easy_setopt(curl, CURLOPT_POSTFIELDS, post_fields);

    res = curl_easy_perform(curl);

    if (res != CURLE_OK){
        fprintf(stderr, "curl_easy_perform() failed: %s\n", curl_easy_strerror(res));
        abort();
    }
    
    curl_easy_cleanup(curl);

    return data;

}

void deleteCurlData(CurlResponse response){

    free(response.data);
    
}
