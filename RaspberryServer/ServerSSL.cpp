/* 
 * File:   ServerSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 06:28 PM
 */

#include "ServerSSL.h"

ServerSSL::ServerSSL() {

    SSL_library_init();

    this->ctx = this->initServerCTX(); /* initialize SSL */

    char cert_file[BUFSIZE];
    strcpy(cert_file, CERT_FILE);

    this->loadCertificates(this->ctx, cert_file, cert_file); /* load certs */
    
    this->socket_fd = this->openListener(PORT_NUM); /* create server socket */
    
    this->last_connection_accepted_fd = -1;
    
}

ServerSSL::~ServerSSL() {
}

int ServerSSL::getLastConnectionAccepted(){
    return this->last_connection_accepted_fd;
}

void ServerSSL::closeLastConnectionAccepted() {
    close(this->last_connection_accepted_fd);
}

SSL_CTX* ServerSSL::initServerCTX() {

    SSL_METHOD *method;
    SSL_CTX *ctx;

    OpenSSL_add_all_algorithms(); /* load & register all cryptos, etc. */
    SSL_load_error_strings(); /* load all error messages */
    method = SSLv3_server_method(); /* create new server-method instance */
    ctx = SSL_CTX_new(method); /* create new context from method */

    if (ctx == NULL) {
        ERR_print_errors_fp(stderr);
        abort();
    }

    return ctx;
}

int ServerSSL::openListener(int port) {

    int sd;
    struct sockaddr_in addr;

    sd = socket(PF_INET, SOCK_STREAM, 0);
    bzero(&addr, sizeof (addr));
    addr.sin_family = AF_INET;
    addr.sin_port = htons(port);
    addr.sin_addr.s_addr = INADDR_ANY;


    int tr = 1;

    if (setsockopt(sd, SOL_SOCKET, SO_REUSEADDR, &tr, sizeof (int)) != 0) {
        perror("setsockopt");
        abort();
    }
    
    if (bind(sd, (struct sockaddr*) &addr, sizeof (addr)) != 0) {
        perror("can't bind port");
        abort();
    }

    if (listen(sd, 10) != 0) {
        perror("Can't configure listening port");
        abort();
    }
    return sd;

}

void ServerSSL::loadCertificates(SSL_CTX* ctx, char* CertFile, char* KeyFile) {

    /* set the local certificate from CertFile */
    if (SSL_CTX_use_certificate_file(ctx, CertFile, SSL_FILETYPE_PEM) <= 0) {
        ERR_print_errors_fp(stderr);
        abort();
    }

    /* set the private key from KeyFile (may be the same as CertFile) */
    if (SSL_CTX_use_PrivateKey_file(ctx, KeyFile, SSL_FILETYPE_PEM) <= 0) {
        ERR_print_errors_fp(stderr);
        abort();
    }

    /* verify private key */
    if (!SSL_CTX_check_private_key(ctx)) {
        fprintf(stderr, "Private key does not match the public certificate\n");
        abort();
    }

}

void ServerSSL::acceptConnection() {
    
    struct sockaddr_in addr;
    socklen_t len = sizeof (addr);

    this->last_connection_accepted_fd = accept(this->socket_fd, (struct sockaddr*) &addr, &len); /* accept connection as usual */

    if (this->last_connection_accepted_fd < 0) {
        fprintf(stderr, "accept failed\n");
        abort();
    }

    printf("Connection: %s:%d\n", inet_ntoa(addr.sin_addr), ntohs(addr.sin_port));

}

void ServerSSL::closeServer() {

    close(this->socket_fd); /* close server socket */
    SSL_CTX_free(this->ctx); /* release context */

}

void ServerSSL::showCerts(SSL* ssl) {

    X509 *cert;
    char *line;

    cert = SSL_get_peer_certificate(ssl); /* Get certificates (if available) */

    if (cert != NULL) {
        printf("Server certificates:\n");
        line = X509_NAME_oneline(X509_get_subject_name(cert), 0, 0);
        printf("Subject: %s\n", line);
        free(line);
        line = X509_NAME_oneline(X509_get_issuer_name(cert), 0, 0);
        printf("Issuer: %s\n", line);
        free(line);
        X509_free(cert);

    } else
        printf("No certificates.\n");
}

SSL_CTX* ServerSSL::getSSLCTX(){
    return this->ctx;
}

void ServerSSL::manageCloseServer(int sig){

    printf("%d > Cerrando Server!!\n", getpid());

    this->closeServer();
    
    exit(sig);
    
}
