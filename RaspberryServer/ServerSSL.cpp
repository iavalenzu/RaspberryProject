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

    this->loadCertificates(this->ctx, CERT_FILE.c_str(), CERT_FILE.c_str()); /* load certs */

    this->socket_fd = this->openListener(PORT_NUM); /* create server socket */

    this->last_connection_accepted_fd = -1;


}

ServerSSL::~ServerSSL() {
}

int ServerSSL::getLastConnectionAccepted() {
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

    if (listen(sd, SOMAXCONN) != 0) {
        perror("Can't configure listening port");
        abort();
    }
    return sd;

}

void ServerSSL::loadCertificates(SSL_CTX* ctx, const char* CertFile, const char* KeyFile) {

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

    cout << getpid() << " > Accept new connection: " << inet_ntoa(addr.sin_addr) << ":" << ntohs(addr.sin_port) << endl;

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
        cout << "Server certificates:" << endl;
        line = X509_NAME_oneline(X509_get_subject_name(cert), 0, 0);
        cout << "Subject: " << line << endl;
        free(line);
        line = X509_NAME_oneline(X509_get_issuer_name(cert), 0, 0);
        cout << "Issuer: " << line << endl;
        free(line);
        X509_free(cert);

    } else
        cout << "No certificates." << endl;
}

SSL_CTX* ServerSSL::getSSLCTX() {
    return this->ctx;
}

void ServerSSL::manageCloseServer(int sig) {

    cout << getpid() << " > Cerrando Server!!" << endl;

    this->closeServer();

    exit(sig);

}

void ServerSSL::closeAllChildProcess() {

    char *buff = NULL;
    size_t len = 255;
    char command[256] = {0};
    pid_t serverpid = getpid();
    
    sprintf(command, "kill -s TERM `ps -ef|awk '$3==%u {print $2}'`", serverpid);
    
    FILE *fp = popen(command, "r");
    
    while (getline(&buff, &len, fp) >= 0) {
        cout << serverpid << " > " << buff << endl;
    }
    
    free(buff);
    fclose(fp);

}