#
# Generated Makefile - do not edit!
#
# Edit the Makefile in the project folder instead (../Makefile). Each target
# has a -pre and a -post target defined where you can add customized code.
#
# This makefile implements configuration specific macros and targets.


# Environment
MKDIR=mkdir
CP=cp
GREP=grep
NM=nm
CCADMIN=CCadmin
RANLIB=ranlib
CC=gcc
CCC=g++
CXX=g++
FC=gfortran
AS=as

# Macros
CND_PLATFORM=GNU-MacOSX
CND_DLIB_EXT=dylib
CND_CONF=Debug
CND_DISTDIR=dist
CND_BUILDDIR=build

# Include project Makefile
include Makefile

# Object Directory
OBJECTDIR=${CND_BUILDDIR}/${CND_CONF}/${CND_PLATFORM}

# Object Files
OBJECTFILES= \
	${OBJECTDIR}/_ext/107232131/Connection.o \
	${OBJECTDIR}/_ext/107232131/Server.o \
	${OBJECTDIR}/_ext/107232131/main.o \
	${OBJECTDIR}/_ext/1219329456/base64.o \
	${OBJECTDIR}/_ext/1219329456/connection.o \
	${OBJECTDIR}/_ext/1219329456/frame.o \
	${OBJECTDIR}/_ext/359540895/md5.o \
	${OBJECTDIR}/_ext/1219329456/websocket.o


# C Compiler Flags
CFLAGS=

# CC Compiler Flags
CCFLAGS=-levent -lssl
CXXFLAGS=-levent -lssl

# Fortran Compiler Flags
FFLAGS=

# Assembler Flags
ASFLAGS=

# Link Libraries and Options
LDLIBSOPTIONS=/usr/local/lib/libevent_openssl-2.0.5.dylib /usr/local/lib/libmysqlcppconn.dylib

# Build Targets
.build-conf: ${BUILD_SUBPROJECTS}
	"${MAKE}"  -f nbproject/Makefile-${CND_CONF}.mk ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/websocketservernonblocking

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/websocketservernonblocking: /usr/local/lib/libevent_openssl-2.0.5.dylib

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/websocketservernonblocking: /usr/local/lib/libmysqlcppconn.dylib

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/websocketservernonblocking: ${OBJECTFILES}
	${MKDIR} -p ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}
	${LINK.cc} -o ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/websocketservernonblocking ${OBJECTFILES} ${LDLIBSOPTIONS} -levent -lssl -lcrypto

${OBJECTDIR}/_ext/107232131/Connection.o: /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/Connection.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/107232131
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/107232131/Connection.o /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/Connection.cpp

${OBJECTDIR}/_ext/107232131/Server.o: /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/Server.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/107232131
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/107232131/Server.o /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/Server.cpp

${OBJECTDIR}/_ext/107232131/main.o: /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/main.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/107232131
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/107232131/main.o /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/main.cpp

${OBJECTDIR}/_ext/1219329456/base64.o: /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/base64.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1219329456
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1219329456/base64.o /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/base64.cpp

${OBJECTDIR}/_ext/1219329456/connection.o: /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/connection.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1219329456
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1219329456/connection.o /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/connection.cpp

${OBJECTDIR}/_ext/1219329456/frame.o: /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/frame.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1219329456
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1219329456/frame.o /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/frame.cpp

${OBJECTDIR}/_ext/359540895/md5.o: /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/md5/md5.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/359540895
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/359540895/md5.o /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/md5/md5.cpp

${OBJECTDIR}/_ext/1219329456/websocket.o: /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/websocket.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1219329456
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1219329456/websocket.o /Users/Ismael/NetBeansProjects/RaspberryProject/WebSocketServerNonBlocking/websocketlib/websocket.cpp

# Subprojects
.build-subprojects:

# Clean Targets
.clean-conf: ${CLEAN_SUBPROJECTS}
	${RM} -r ${CND_BUILDDIR}/${CND_CONF}
	${RM} ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/websocketservernonblocking

# Subprojects
.clean-subprojects:

# Enable dependency checking
.dep.inc: .depcheck-impl

include .dep.inc
