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
	${OBJECTDIR}/ConnectionSSL.o \
	${OBJECTDIR}/DatabaseAdapter.o \
	${OBJECTDIR}/Device.o \
	${OBJECTDIR}/Logger.o \
	${OBJECTDIR}/Notification.o \
	${OBJECTDIR}/NotificationAuthorized.o \
	${OBJECTDIR}/NotificationNotAuthorized.o \
	${OBJECTDIR}/RaspiUtils.o \
	${OBJECTDIR}/ServerSSL.o \
	${OBJECTDIR}/main.o


# C Compiler Flags
CFLAGS=

# CC Compiler Flags
CCFLAGS=
CXXFLAGS=

# Fortran Compiler Flags
FFLAGS=

# Assembler Flags
ASFLAGS=

# Link Libraries and Options
LDLIBSOPTIONS=/usr/local/lib/libmysqlcppconn.dylib /usr/lib/libjson.a

# Build Targets
.build-conf: ${BUILD_SUBPROJECTS}
	"${MAKE}"  -f nbproject/Makefile-${CND_CONF}.mk ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver: /usr/local/lib/libmysqlcppconn.dylib

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver: /usr/lib/libjson.a

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver: ${OBJECTFILES}
	${MKDIR} -p ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}
	${LINK.cc} -o ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver ${OBJECTFILES} ${LDLIBSOPTIONS} -lssl -lcrypto -lm -lcurl

${OBJECTDIR}/ConnectionSSL.o: ConnectionSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ConnectionSSL.o ConnectionSSL.cpp

${OBJECTDIR}/DatabaseAdapter.o: DatabaseAdapter.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/DatabaseAdapter.o DatabaseAdapter.cpp

${OBJECTDIR}/Device.o: Device.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/Device.o Device.cpp

${OBJECTDIR}/Logger.o: Logger.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/Logger.o Logger.cpp

${OBJECTDIR}/Notification.o: Notification.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/Notification.o Notification.cpp

${OBJECTDIR}/NotificationAuthorized.o: NotificationAuthorized.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/NotificationAuthorized.o NotificationAuthorized.cpp

${OBJECTDIR}/NotificationNotAuthorized.o: NotificationNotAuthorized.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/NotificationNotAuthorized.o NotificationNotAuthorized.cpp

${OBJECTDIR}/RaspiUtils.o: RaspiUtils.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/RaspiUtils.o RaspiUtils.cpp

${OBJECTDIR}/ServerSSL.o: ServerSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ServerSSL.o ServerSSL.cpp

${OBJECTDIR}/main.o: main.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -Wall -I/usr/include -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/main.o main.cpp

# Subprojects
.build-subprojects:

# Clean Targets
.clean-conf: ${CLEAN_SUBPROJECTS}
	${RM} -r ${CND_BUILDDIR}/${CND_CONF}
	${RM} ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver

# Subprojects
.clean-subprojects:

# Enable dependency checking
.dep.inc: .depcheck-impl

include .dep.inc
