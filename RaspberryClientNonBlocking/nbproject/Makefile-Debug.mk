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
	${OBJECTDIR}/_ext/1335234418/Action.o \
	${OBJECTDIR}/_ext/1335234418/ActionExecutor.o \
	${OBJECTDIR}/_ext/1335234418/ActionFactory.o \
	${OBJECTDIR}/_ext/1335234418/ActionGetFortune.o \
	${OBJECTDIR}/_ext/1335234418/ActionStartPinMeter.o \
	${OBJECTDIR}/_ext/1335234418/ActionStopPinMeter.o \
	${OBJECTDIR}/_ext/1335234418/ClientSSL.o \
	${OBJECTDIR}/_ext/1335234418/ConnectionSSL.o \
	${OBJECTDIR}/_ext/1335234418/IncomingAction.o \
	${OBJECTDIR}/_ext/1335234418/IncomingActionExecutor.o \
	${OBJECTDIR}/_ext/1335234418/IncomingActionFactory.o \
	${OBJECTDIR}/_ext/1335234418/JSONBuffer.o \
	${OBJECTDIR}/_ext/1335234418/Notification.o \
	${OBJECTDIR}/_ext/1494676077/JSONAllocator.o \
	${OBJECTDIR}/_ext/1494676077/JSONChildren.o \
	${OBJECTDIR}/_ext/1494676077/JSONDebug.o \
	${OBJECTDIR}/_ext/1494676077/JSONIterators.o \
	${OBJECTDIR}/_ext/1494676077/JSONMemory.o \
	${OBJECTDIR}/_ext/1494676077/JSONNode.o \
	${OBJECTDIR}/_ext/1494676077/JSONNode_Mutex.o \
	${OBJECTDIR}/_ext/1494676077/JSONPreparse.o \
	${OBJECTDIR}/_ext/1494676077/JSONStream.o \
	${OBJECTDIR}/_ext/1494676077/JSONValidator.o \
	${OBJECTDIR}/_ext/1494676077/JSONWorker.o \
	${OBJECTDIR}/_ext/1494676077/JSONWriter.o \
	${OBJECTDIR}/_ext/1494676077/internalJSONNode.o \
	${OBJECTDIR}/_ext/1494676077/libjson.o \
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
LDLIBSOPTIONS=/usr/local/lib/libevent_openssl.dylib

# Build Targets
.build-conf: ${BUILD_SUBPROJECTS}
	"${MAKE}"  -f nbproject/Makefile-${CND_CONF}.mk ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryclientnonblocking

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryclientnonblocking: /usr/local/lib/libevent_openssl.dylib

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryclientnonblocking: ${OBJECTFILES}
	${MKDIR} -p ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}
	${LINK.cc} -o ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryclientnonblocking ${OBJECTFILES} ${LDLIBSOPTIONS} -lssl -lcrypto -lm -lcurl -levent

${OBJECTDIR}/_ext/1335234418/Action.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/Action.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/Action.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/Action.cpp

${OBJECTDIR}/_ext/1335234418/ActionExecutor.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionExecutor.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/ActionExecutor.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionExecutor.cpp

${OBJECTDIR}/_ext/1335234418/ActionFactory.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/ActionFactory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionFactory.cpp

${OBJECTDIR}/_ext/1335234418/ActionGetFortune.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionGetFortune.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/ActionGetFortune.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionGetFortune.cpp

${OBJECTDIR}/_ext/1335234418/ActionStartPinMeter.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionStartPinMeter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/ActionStartPinMeter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionStartPinMeter.cpp

${OBJECTDIR}/_ext/1335234418/ActionStopPinMeter.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionStopPinMeter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/ActionStopPinMeter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ActionStopPinMeter.cpp

${OBJECTDIR}/_ext/1335234418/ClientSSL.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ClientSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/ClientSSL.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ClientSSL.cpp

${OBJECTDIR}/_ext/1335234418/ConnectionSSL.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ConnectionSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/ConnectionSSL.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/ConnectionSSL.cpp

${OBJECTDIR}/_ext/1335234418/IncomingAction.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/IncomingAction.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/IncomingAction.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/IncomingAction.cpp

${OBJECTDIR}/_ext/1335234418/IncomingActionExecutor.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/IncomingActionExecutor.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/IncomingActionExecutor.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/IncomingActionExecutor.cpp

${OBJECTDIR}/_ext/1335234418/IncomingActionFactory.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/IncomingActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/IncomingActionFactory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/IncomingActionFactory.cpp

${OBJECTDIR}/_ext/1335234418/JSONBuffer.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/JSONBuffer.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/JSONBuffer.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/JSONBuffer.cpp

${OBJECTDIR}/_ext/1335234418/Notification.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/Notification.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1335234418
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1335234418/Notification.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/Notification.cpp

${OBJECTDIR}/_ext/1494676077/JSONAllocator.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONAllocator.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONAllocator.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONAllocator.cpp

${OBJECTDIR}/_ext/1494676077/JSONChildren.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONChildren.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONChildren.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONChildren.cpp

${OBJECTDIR}/_ext/1494676077/JSONDebug.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONDebug.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONDebug.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONDebug.cpp

${OBJECTDIR}/_ext/1494676077/JSONIterators.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONIterators.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONIterators.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONIterators.cpp

${OBJECTDIR}/_ext/1494676077/JSONMemory.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONMemory.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONMemory.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONMemory.cpp

${OBJECTDIR}/_ext/1494676077/JSONNode.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONNode.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONNode.cpp

${OBJECTDIR}/_ext/1494676077/JSONNode_Mutex.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONNode_Mutex.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONNode_Mutex.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONNode_Mutex.cpp

${OBJECTDIR}/_ext/1494676077/JSONPreparse.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONPreparse.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONPreparse.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONPreparse.cpp

${OBJECTDIR}/_ext/1494676077/JSONStream.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONStream.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONStream.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONStream.cpp

${OBJECTDIR}/_ext/1494676077/JSONValidator.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONValidator.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONValidator.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONValidator.cpp

${OBJECTDIR}/_ext/1494676077/JSONWorker.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONWorker.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONWorker.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONWorker.cpp

${OBJECTDIR}/_ext/1494676077/JSONWriter.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONWriter.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/JSONWriter.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/JSONWriter.cpp

${OBJECTDIR}/_ext/1494676077/internalJSONNode.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/internalJSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/internalJSONNode.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/internalJSONNode.cpp

${OBJECTDIR}/_ext/1494676077/libjson.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/libjson.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/1494676077
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/1494676077/libjson.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryClientNonBlocking/libjson/_internal/Source/libjson.cpp

${OBJECTDIR}/main.o: main.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/main.o main.cpp

# Subprojects
.build-subprojects:

# Clean Targets
.clean-conf: ${CLEAN_SUBPROJECTS}
	${RM} -r ${CND_BUILDDIR}/${CND_CONF}
	${RM} ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryclientnonblocking

# Subprojects
.clean-subprojects:

# Enable dependency checking
.dep.inc: .depcheck-impl

include .dep.inc
