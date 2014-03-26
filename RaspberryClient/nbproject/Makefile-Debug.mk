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
	${OBJECTDIR}/_ext/1604071451/ActionFactory.o \
	${OBJECTDIR}/_ext/1604071451/IncomingAction.o \
	${OBJECTDIR}/_ext/1604071451/Notification.o \
	${OBJECTDIR}/_ext/1604071451/RaspiUtils.o \
	${OBJECTDIR}/_ext/1293681001/JSONAllocator.o \
	${OBJECTDIR}/_ext/1293681001/JSONChildren.o \
	${OBJECTDIR}/_ext/1293681001/JSONDebug.o \
	${OBJECTDIR}/_ext/1293681001/JSONIterators.o \
	${OBJECTDIR}/_ext/1293681001/JSONMemory.o \
	${OBJECTDIR}/_ext/1293681001/JSONNode.o \
	${OBJECTDIR}/_ext/1293681001/JSONNode_Mutex.o \
	${OBJECTDIR}/_ext/1293681001/JSONPreparse.o \
	${OBJECTDIR}/_ext/1293681001/JSONStream.o \
	${OBJECTDIR}/_ext/1293681001/JSONValidator.o \
	${OBJECTDIR}/_ext/1293681001/JSONWorker.o \
	${OBJECTDIR}/_ext/1293681001/JSONWriter.o \
	${OBJECTDIR}/_ext/1293681001/internalJSONNode.o \
	${OBJECTDIR}/_ext/1293681001/libjson.o \
	${OBJECTDIR}/src/Action.o \
	${OBJECTDIR}/src/ActionGetFortune.o \
	${OBJECTDIR}/src/ActionStopClient.o \
	${OBJECTDIR}/src/ActionUpdateClient.o \
	${OBJECTDIR}/src/ConnectionSSL.o \
	${OBJECTDIR}/src/Device.o \
	${OBJECTDIR}/src/IncomingActionFactory.o \
	${OBJECTDIR}/src/main.o


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
LDLIBSOPTIONS=

# Build Targets
.build-conf: ${BUILD_SUBPROJECTS}
	"${MAKE}"  -f nbproject/Makefile-${CND_CONF}.mk ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryclient

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryclient: ${OBJECTFILES}
	${MKDIR} -p ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}
	${LINK.cc} -o ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryclient ${OBJECTFILES} ${LDLIBSOPTIONS} -lssl -lcrypto -lm -lcurl

${OBJECTDIR}/_ext/1604071451/ActionFactory.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClient/src/ActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1604071451
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1604071451/ActionFactory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClient/src/ActionFactory.cpp

${OBJECTDIR}/_ext/1604071451/IncomingAction.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClient/src/IncomingAction.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1604071451
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1604071451/IncomingAction.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClient/src/IncomingAction.cpp

${OBJECTDIR}/_ext/1604071451/Notification.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClient/src/Notification.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1604071451
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1604071451/Notification.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClient/src/Notification.cpp

${OBJECTDIR}/_ext/1604071451/RaspiUtils.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClient/src/RaspiUtils.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1604071451
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1604071451/RaspiUtils.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClient/src/RaspiUtils.cpp

${OBJECTDIR}/_ext/1293681001/JSONAllocator.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONAllocator.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONAllocator.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONAllocator.cpp

${OBJECTDIR}/_ext/1293681001/JSONChildren.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONChildren.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONChildren.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONChildren.cpp

${OBJECTDIR}/_ext/1293681001/JSONDebug.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONDebug.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONDebug.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONDebug.cpp

${OBJECTDIR}/_ext/1293681001/JSONIterators.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONIterators.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONIterators.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONIterators.cpp

${OBJECTDIR}/_ext/1293681001/JSONMemory.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONMemory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONMemory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONMemory.cpp

${OBJECTDIR}/_ext/1293681001/JSONNode.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONNode.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONNode.cpp

${OBJECTDIR}/_ext/1293681001/JSONNode_Mutex.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONNode_Mutex.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONNode_Mutex.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONNode_Mutex.cpp

${OBJECTDIR}/_ext/1293681001/JSONPreparse.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONPreparse.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONPreparse.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONPreparse.cpp

${OBJECTDIR}/_ext/1293681001/JSONStream.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONStream.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONStream.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONStream.cpp

${OBJECTDIR}/_ext/1293681001/JSONValidator.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONValidator.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONValidator.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONValidator.cpp

${OBJECTDIR}/_ext/1293681001/JSONWorker.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONWorker.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONWorker.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONWorker.cpp

${OBJECTDIR}/_ext/1293681001/JSONWriter.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONWriter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/JSONWriter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/JSONWriter.cpp

${OBJECTDIR}/_ext/1293681001/internalJSONNode.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/internalJSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/internalJSONNode.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/internalJSONNode.cpp

${OBJECTDIR}/_ext/1293681001/libjson.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/libjson.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1293681001
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1293681001/libjson.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/libjson/_internal/Source/libjson.cpp

${OBJECTDIR}/src/Action.o: src/Action.cpp 
	${MKDIR} -p ${OBJECTDIR}/src
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/src/Action.o src/Action.cpp

${OBJECTDIR}/src/ActionGetFortune.o: src/ActionGetFortune.cpp 
	${MKDIR} -p ${OBJECTDIR}/src
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/src/ActionGetFortune.o src/ActionGetFortune.cpp

${OBJECTDIR}/src/ActionStopClient.o: src/ActionStopClient.cpp 
	${MKDIR} -p ${OBJECTDIR}/src
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/src/ActionStopClient.o src/ActionStopClient.cpp

${OBJECTDIR}/src/ActionUpdateClient.o: src/ActionUpdateClient.cpp 
	${MKDIR} -p ${OBJECTDIR}/src
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/src/ActionUpdateClient.o src/ActionUpdateClient.cpp

${OBJECTDIR}/src/ConnectionSSL.o: src/ConnectionSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}/src
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/src/ConnectionSSL.o src/ConnectionSSL.cpp

${OBJECTDIR}/src/Device.o: src/Device.cpp 
	${MKDIR} -p ${OBJECTDIR}/src
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/src/Device.o src/Device.cpp

${OBJECTDIR}/src/IncomingActionFactory.o: src/IncomingActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}/src
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/src/IncomingActionFactory.o src/IncomingActionFactory.cpp

${OBJECTDIR}/src/main.o: src/main.cpp 
	${MKDIR} -p ${OBJECTDIR}/src
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/src/main.o src/main.cpp

# Subprojects
.build-subprojects:

# Clean Targets
.clean-conf: ${CLEAN_SUBPROJECTS}
	${RM} -r ${CND_BUILDDIR}/${CND_CONF}
	${RM} ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryclient

# Subprojects
.clean-subprojects:

# Enable dependency checking
.dep.inc: .depcheck-impl

include .dep.inc
